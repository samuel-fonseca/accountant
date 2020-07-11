<template>
<div id="invoice-home">
  <b-card no-body>

    <b-row align-h="between" class="m-2">
      <b-col sm="12" md="12" lg="5" class="my-1">
        <b-pagination
          v-model="table.pagination.currentPage"
          :total-rows="invoices.length"
          :per-page="table.pagination.perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>

      <b-col sm="12" md="6" lg="5" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="table.filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!table.filter" @click="table.filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="12" md="6" lg="2" class="my-1">
        <b-form-group
          label="Show"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="itemsPerPage"
          class="mb-0">
          <b-form-select size="sm" id="itemsPerPage" v-model="table.pagination.perPage" :options="itemsPerPageIncrements"></b-form-select>
        </b-form-group>
      </b-col>
    </b-row>

    <b-table ref="invoicesTable"
      :busy="loading"
      bordered
      striped
      responsive
      foot-clone
      stacked="sm"
      :fields="table.fields"
      :items="tableViewInvoices"
      :current-page="table.pagination.currentPage"
      :per-page="table.pagination.perPage"
      :filter="table.filter"
      selectable
      select-mode="single"
      @row-selected="invoiceSelected"
    >
      <!-- Loading spin -->
      <template v-slot:table-busy>
        <div class="text-center text-success my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    </b-table>

  </b-card>

  <b-modal
    ok-only
    size="lg"
    scrollable
    :title="invoiceModal.title"
    :id="invoiceModal.id"
    @hidden="clearSelectedInvoice"
    @ok="clearSelectedInvoice">
    <view-invoice :invoice="invoiceModal.invoice"></view-invoice>
  </b-modal>

</div>
</template>

<script>
import { mapGetters } from 'vuex';
import EventBus from '@/vue/event-bus';
import ViewInvoice from './View';

export default {
  mounted() {
    // listen for invoice delete & close modal
    EventBus.$on('invoiceDeleted', (payload) => this.invoiceDeleted(payload))
  },
  props: {
    loading: Boolean
  },
  components: {
    ViewInvoice
  },
  data() {
    return {
      table: {
        filter: null,
        fields: [
          {key: 'invoice_number', label: 'Invoice #', sortable: true},
          {key: 'name', sortable: true},
          {key: 'total_due', sortable: true},
          {key: 'invoice_date', sortable: true},
          {key: 'due_date', sortable: true},
        ],
        pagination: {
          currentPage: 1,
          perPage: 25
        }
      },
      invoiceModal: {
        id: 'invoice-modal',
        title: '',
        invoice: null,
      },
    }
  },
  methods: {
    invoiceSelected(invoice) {
      if (invoice[0])
        this.invoiceModal.invoice = this.invoices.filter(f => f.id === invoice[0].id)[0];

      this.invoiceModal.title = `Invoice ${this.invoiceModal.invoice.invoice_number}`
      this.$root.$emit('bv::show::modal', this.invoiceModal.id)
    },
    clearSelectedInvoice() {
      this.invoiceModal = {
        id: 'invoice-modal',
        title: '',
        invoice: null,
      };
      this.$refs.invoicesTable.clearSelected();
    },
    invoiceDeleted(payload) {
      this.$bvModal.hide(this.invoiceModal.id);
      this.$bvToast.toast(payload.data.message, {
        title: '✅ Invoice Deleted',
        autoHideDelay: 5000
      })
    }
  },
  computed: {
    tableViewInvoices() {
      let data = [],
          temp = {};

      this.invoices.forEach(invoice => {
        
        if (invoice.payments.length) {
          total_due = invoice.total - (invoice.payments.reduce((previous, current) => previous.total + current.total));
        }

        temp = {
          id: invoice.id,
          invoice_number: invoice.invoice_number,
          total_due: this.$options.filters.toUSD(invoice.total),
          invoice_date: new Date(invoice.invoiced_at).toLocaleDateString(),
          due_date: new Date(invoice.due_at).toLocaleDateString(),
        };
        if (invoice.client)
          temp.name = invoice.client.display_name || `${invoice.client.firstname} ${invoice.client.lastname}`;
        else
          temp.name = 'Customer undefined'

        data.push(temp);
      });

      return data;
    },
    itemsPerPageIncrements() {
      let arr = [5, 25, 50],
          limit = this.invoices.length;

      for (var i = 100; i <= 500; i += 50) {
        if (i >= limit) { break; }
        // push increment
        arr.push(i);
      }

      arr.push(limit);

      return arr;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>