<template>
  <b-card header="New Invoice">
    <b-form @submit.prevent="newClient">

      <b-row class="mb-5">
        <b-col cols="12">
          <h5><b-icon-person-plus></b-icon-person-plus> Client</h5>
        </b-col>
        <b-col cols="12" class="mb-4">
          <b-form-select v-model="invoice.client_id" name="client_id" :options="selectClientList">
            <template v-slot:first>
              <b-form-select-option :value="null" disabled>-- Please select a client --</b-form-select-option>
            </template>
          </b-form-select>
        </b-col>

        <template v-if="invoice.client_id">
          <b-col cols="8">
            <h6 class="text-muted">Bill To</h6>
            <p>
              <span v-if="selectedClient.firstname || selectedClient.lastname">{{ selectedClient.firstname }} {{ selectedClient.lastname }}<br /></span>
              <span v-if="selectedClient.company">{{ selectedClient.company }}<br /></span>
              {{ selectedClient.address }}<br />
              {{ selectedClient.city }}, {{ selectedClient.state }} {{ selectedClient.zip }}<br />
              {{ selectedClient.country }}<br />
            </p>
          </b-col>
          <b-col cols="4">
            <h6 class="text-muted">Contact</h6>
            <p>
              <b-icon-envelope></b-icon-envelope> {{ selectedClient.email }}<br />
              <b-icon-phone></b-icon-phone> {{ selectedClient.phone }}
            </p>
          </b-col>
        </template>
      </b-row>

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
          <b-table-simple striped bordered outlined hover>
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
                    <b-form-textarea size="sm" v-model="item.description" name="item.description[]" cols="65" required></b-form-textarea>
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
                  <b-form-group>
                    {{ item.quantity * item.rate }}
                  </b-form-group>
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
          <b-table-simple>
            <b-tr>
              <b-th>Discounts</b-th>
              <b-td>
                <b-input-group size="sm" prepend="$">
                  <b-input size="sm" v-model="invoice.discounts" type="number" step=".01" name="discounts" required></b-input>
                </b-input-group>
              </b-td>
            </b-tr>
            <b-tr>
              <b-th>Payments</b-th>
              <b-td>{{ paymentsApplied }}</b-td>
            </b-tr>
            <b-tr>
              <b-th>Total Due</b-th>
              <b-td>{{ calculateTotalLineItems }}</b-td>
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
</template>

<script>
import statesJson from '@/data/states';
import { mapGetters } from 'vuex';

export default {
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
          amount: '',
        }],
        message: '',
        discounts: 0.00,
        tax: 0.00,
        total: '',
        invoiced_at: new Date(),
        due_at: new Date()
      }
    }
  },
  methods: {
    newInvoice() {
      this.loading = true;
      let action = this.invoice.id ? 'updateInvoice' : 'createInvoice';

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
  },
  computed: {
    selectClientList() {
      let clients = this.clients,
          selectable = [];

      clients.forEach(c => {
        selectable.push({
          text: c.firstname + ' ' + c.lastname,
          value: c.id
        })
      })

      return selectable;
    },
    selectedClient() {
      if (this.invoice.client_id)
        return this.clients.find(c => c.id === this.invoice.client_id);

      return {};
    },
    calculateTotalLineItems() {
      return 100.00
    },
    paymentsApplied() {
      return 0;
    },
    ...mapGetters(['clients'])
  }
}
</script>

<style>

</style>