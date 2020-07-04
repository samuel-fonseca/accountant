<template>
<div id="invoice-home">
  <b-card no-body>

    <b-row class="m-2">
      <b-col sm="7" md="8" lg="6" class="my-1">
        <b-pagination
          v-model="table.pagination.currentPage"
          :total-rows="invoices.length"
          :per-page="table.pagination.perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>

      <b-col sm="12" md="4" lg="6" class="my-1">
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

  <b-modal size="lg" scrollable :title="invoiceModal.title" :id="invoiceModal.id" ok-only @hidden="clearSelectedInvoice" @ok="clearSelectedInvoice">
    <view-invoice :invoice="invoiceModal.invoice"></view-invoice>
  </b-modal>

</div>
</template>

<script>
import { mapGetters } from 'vuex';
import ViewInvoice from './View';

export default {
  props: {
    loading: Boolean
  },
  data() {
    return {
      table: {
        filter: null,
        fields: [
          {key: 'invoice_number', label: 'Invoice #', sortable: true},
          {key: 'name', sortable: true},
          {key: 'total', sortable: true},
          {key: 'invoice_date', sortable: true},
          {key: 'due_date', sortable: true} 
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
  components: {
    ViewInvoice
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
    }
  },
  computed: {
    tableViewInvoices() {
      let data = [],
          temp = {};

      this.invoices.forEach(invoice => {
        temp = {
          id: invoice.id,
          invoice_number: invoice.invoice_number,
          total: this.$options.filters.toUSD(invoice.total),
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
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>