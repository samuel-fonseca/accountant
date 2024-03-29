<template>
<b-row class="justify-content-center">
  <b-col sm="12" md="10" lg="8">
    <b-overlay :show="loading">
      <b-card>
        <template v-slot:header>
          <span v-if="update">Update invoice</span>
          <span v-else>New invoice</span>
        </template>

        <b-form @submit.prevent="newInvoice">

          <select-client :invoice.sync="invoice"></select-client>

          <dates-selection :invoice.sync="invoice"></dates-selection>

          <b-row>
            <b-col cols="12">
              <line-items :invoice.sync="invoice"></line-items>
            </b-col>
          </b-row>

          <b-row class="my-4">
            <b-col sm="12" md="6">
              <h6 class="text-muted">Invoice Terms</h6>
              <b-form-textarea size="sm" v-model="invoice.message" name="message"></b-form-textarea>
            </b-col>

            <b-col sm="12" md="6">
              <b-table-simple borderless>
                <b-tr>
                  <b-th>Discounts</b-th>
                  <b-td>
                    <b-input-group size="sm" prepend="$">
                      <b-input size="sm" v-model="invoice.discount" type="number" step=".01" name="discount"></b-input>
                    </b-input-group>
                  </b-td>
                </b-tr>
                <!-- <b-tr v-if="invoice.payments">
                  <b-th>Payments</b-th>
                  <b-td>{{ paymentsApplied }}</b-td>
                </b-tr> -->
                <b-tr>
                  <b-th>Total Due</b-th>
                  <b-td>{{ calculateTotalLineItems | toUSD }}</b-td>
                </b-tr>
              </b-table-simple>
            </b-col>
          </b-row>

          <hr />

          <display-error :error="error"></display-error>

          <b-button pill :disabled="loading" block size="lg" type="submit" variant="primary">
            <b-icon-circle-fill v-show="loading" animation="throb"></b-icon-circle-fill>
            <span v-if="update">Update</span>
            <span v-else>Create</span>
          </b-button>
          
        </b-form>
      </b-card>
    </b-overlay>
  </b-col>
</b-row>
</template>

<script>
import EventBus from '@/vue/event-bus';
import statesJson from '@/data/states';

import DisplayError from '@components/Errors';

import SelectClient from '@components/Invoices/Form/SelectClient';
import LineItems from '@components/Invoices/Form/LineItems';
import DatesSelection from '@components/Invoices/Form/Dates';

export default {
  components: {
    SelectClient, LineItems, DatesSelection, DisplayError,
  },
  mounted() {
    if (this.$route.params.id) {
      this.update = true;
      this.getEditableInvoice()
    } else {
      this.loading = false;
    }
  },
  data() {
    // set invoices dates
    const invoiceDate = new Date();
    const dueDate = new Date();
    dueDate.setMonth(dueDate.getMonth() + 1); // Add 1 month from today

    return {
      update: false,
      states: statesJson,
      loading: true,
      error: null,
      invoice: {
        client_id: this.$route.query.client_id || null,
        invoice_number: '',
        line_items: [{
          description: null,
          quantity: null,
          rate: null,
          total: 0
        }],
        message: '',
        discount: 0.00,
        tax: 0.00,
        total: 0.00,
        invoiced_at: invoiceDate,
        due_at: dueDate
      }
    }
  },
  methods: {
    newInvoice() {
      this.loading = true;
      this.error = null;
      let action = this.invoice.id ? 'updateInvoice' : 'createInvoice';

      this.invoice.total = this.calculateTotalLineItems;
      this.invoice.line_items.forEach(item => item.total = item.quantity * item.rate);

      this.$store.dispatch(action, this.invoice)
        .then(res => this.$router.push(`/invoices`))
        .catch(err => {
          console.log(err);
          this.error = err.response.data;
        })
        .finally(() => this.loading = false);
    },

    getEditableInvoice() {
      this.$store.dispatch('fetchInvoice', this.$route.params.id)
        .then(res => {
          let invoice = res.data;
          invoice.line_items = JSON.parse(invoice.line_items);
          this.invoice = invoice;
        })
        .catch(err => console.log(err))
        .finally(() => this.loading = false);
    }
  },
  computed: {
    updateTotalDue(index) {
      this.invoice.line_items.forEach(item => {
        if (item.quantity && item.rate) {
          item.total = item.quantity * item.rate;
        }
      });

      return 0;
    },
    calculateTotalLineItems() {
      let items = this.invoice.line_items,
          total = 0;

      if (items) {
        items.forEach(a => total += (a.quantity * a.rate));
      }

      return total - this.invoice.discount;
    },
    paymentsApplied() {
      return 0;
    },
    // clientId () {
    //   let client_id = this.$route.query.client_id;

    //   if (client_id)
    //     return client_id
    // }
  }
}
</script>

<style>

</style>