<template>
<b-row class="justify-content-center">
  <b-col sm="12" md="10" lg="8">
    <b-card header="New Invoice">
      <b-form @submit.prevent="newInvoice">

        <select-client :invoice.sync="invoice"></select-client>

        <b-row>
          <b-col cols="6">
            <b-form-group label="Invoice Date">
              <b-form-datepicker id="invoiced_at" v-model="invoice.invoiced_at" class="mb-2"></b-form-datepicker>
            </b-form-group>
          </b-col>
          <b-col cols="6">
            <b-form-group label="Invoice Due On">
              <b-form-datepicker id="due_at" v-model="invoice.due_at" class="mb-2"></b-form-datepicker>
            </b-form-group>
          </b-col>
        </b-row>

        <b-row>
          <b-col cols="12">
            <b-table-simple small responsive striped bordered outlined hover>
              <b-thead>
                <b-tr>
                  <b-th>Description</b-th>
                  <b-th>Quantity</b-th>
                  <b-th>Rate</b-th>
                  <b-th>Amount</b-th>
                  <b-th></b-th>
                </b-tr>
              </b-thead>
              <b-tbody>
                <b-tr v-for="(item, index) in invoice.line_items" :key="index">
                  <b-td>
                    <b-form-group>
                      <b-form-textarea size="sm" v-model="item.description" name="item.description[]" cols="75" rows="1" required></b-form-textarea>
                    </b-form-group>
                  </b-td>
                  <b-td>
                    <b-form-group>
                      <b-input size="sm" v-model="item.quantity" type="number" step="1.0" name="item.quantity[]" required></b-input>
                    </b-form-group>
                  </b-td>
                  <b-td>
                    <b-input-group size="sm" prepend="$">
                      <b-input size="sm" v-model="item.rate" type="number" step=".01" name="item.rate[]" required></b-input>
                    </b-input-group>
                  </b-td>
                  <b-td>
                    {{ item.quantity * item.rate | toUSD }}
                  </b-td>
                  <b-td>
                    <b-button variant="danger" size="sm" @click="removeLineItem(index)"><b-icon-trash></b-icon-trash></b-button>
                  </b-td>
                </b-tr>
              </b-tbody>
            </b-table-simple>

            <b-button @click.prevent="addLineItem"><b-icon-plus></b-icon-plus> Line Item</b-button>
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

        <b-button :disabled="loading" block size="lg" type="submit" variant="primary">
          <b-icon-circle-fill v-show="loading" animation="throb"></b-icon-circle-fill>
          Create
        </b-button>
        
      </b-form>
    </b-card>
  </b-col>
</b-row>
</template>

<script>
import EventBus from '@/vue/event-bus';
import statesJson from '@/data/states';

import SelectClient from '@components/Invoices/Partial/Form/SelectClient';

export default {
  components: {SelectClient},
  data() {
    return {
      states: statesJson,
      loading: false,
      invoice: {
        client_id: null,
        invoice_number: '',
        line_items: [{
          description: '',
          quantity: '',
          rate: '',
        }],
        message: '',
        discount: 0.00,
        tax: 0.00,
        total: 0.00,
        invoiced_at: new Date(),
        due_at: new Date()
      }
    }
  },
  methods: {
    newInvoice() {
      this.loading = true;
      let action = this.invoice.id ? 'updateInvoice' : 'createInvoice';

      this.invoice.total = this.calculateTotalLineItems;

      this.$store.dispatch(action, this.invoice)
        .then(() => {
          this.$router.push({ name: 'invoices.home' })
        })
        .catch(err => {
          console.error(err);
          alert('Could not save invoice right now. Try again later.');
        })
        .finally(() => this.loading = false);
    },
    addLineItem() {
      this.invoice.line_items.push({
        description: '', quantity: '', rate: '', amount: ''
      })
    },
    removeLineItem(index) {
      this.invoice.line_items.splice(index, 1)
    },
    fetchClients() {
      return this.$store.dispatch('fetchClients');
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
  }
}
</script>

<style>

</style>