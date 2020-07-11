<template>
  <div id="view-invoice">
    <b-row class="mb-4">
      <b-col cols="12" class="mb-2">
        <b-button-toolbar aria-label="Invoice Action Toolbar">
          <b-button-group class="mr-1">
            <b-button variant="light" :to="`/invoices/${invoice.id}/edit`">
              <b-icon icon="pencil-square"></b-icon>
              Edit
            </b-button>
            <b-button disabled variant="light" @click.prevent="sendEmail()">
              <b-icon icon="envelope"></b-icon>
              Send
            </b-button>
            <b-button disabled variant="light" @click.prevent="dowloadPdf()">
              <b-icon icon="download"></b-icon>
              Download
            </b-button>
            <b-button variant="light" :to="`/invoices/${invoice.id}/payment`">
              <b-icon icon="moon"></b-icon>
              Receive Payment
            </b-button>
            <b-button variant="danger" @click.prevent="deleteInvoice(invoice.id)">
              <b-icon icon="x"></b-icon>
              Delete
            </b-button>
          </b-button-group>
        </b-button-toolbar>
      </b-col>
    </b-row>
    <b-row>
      <b-col sm="12" md="6">
        <h6 class="text-muted">Bill To</h6>
        <p>
          <span v-if="invoice.client.firstname || invoice.client.lastname">{{ invoice.client.firstname }} {{ invoice.client.lastname }}<br /></span>
          <span v-if="invoice.client.company">{{ invoice.client.company }}<br /></span>
          {{ invoice.client.address }}<br />
          {{ invoice.client.city }}, {{ invoice.client.state }} {{ invoice.client.zip }}<br />
          {{ invoice.client.country }}<br />
        </p>
      </b-col>
      <b-col sm="12" md="6">
        <h6 class="text-muted">Contact</h6>
        <p>
          <b-icon-envelope></b-icon-envelope> <a :href="`mailto:${invoice.client.email}`">{{ invoice.client.email }}</a><br />
          <b-icon-phone></b-icon-phone> {{ invoice.client.phone }}
        </p>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12" md="6">
        <h6 class="text-muted">Invoiced Date</h6>
        <p>{{ invoice.invoiced_at | localeDate }}</p>
      </b-col>
      <b-col sm="12" md="6">
        <h6 class="text-muted">Due Date</h6>
        <p>{{ invoice.due_at | localeDate }}</p>
      </b-col>
    </b-row>

    <b-row>
      <b-col cols="12">
        <b-table head-variant="dark" bordered striped :items="lineItems" :fields="fields">
          <template v-slot:cell(rate)="row">
            {{ row.value | toUSD }}
          </template>
          <template v-slot:cell(total)="row">
            {{ lineItems[row.index].quantity * lineItems[row.index].rate | toUSD }}
          </template>
        </b-table>
      </b-col>
    </b-row>

    <b-row>
      
      <b-col sm="12" md="6" lg="4">
        <h6 class="text-muted">Invoice Message</h6>
        <p>{{ invoice.message }}</p>
      </b-col>

      <b-col sm="12" md="6" lg="8">
        <b-table-simple borderless>
          <b-tr>
            <b-th>Discounts</b-th>
            <b-td>
              {{ invoice.discount | toUSD }}
            </b-td>
          </b-tr>
          <b-tr>
            <b-th>Taxes</b-th>
            <b-td>{{ invoice.tax | toUSD }}</b-td>
          </b-tr>
          <b-tr>
            <b-th>Invoice Amount</b-th>
            <b-td>{{ invoice.total | toUSD }}</b-td>
          </b-tr>
        </b-table-simple>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import EventBus from '@/vue/event-bus';

export default {
  data() {
    return {
      fields: ['description', 'quantity', 'rate', 'total']
    }
  },
  props: {
    invoice: Object
  },
  computed: {
    lineItems() {
      return JSON.parse(this.invoice.line_items);
    }
  },
  methods: {
    logThis(data) {
      console.log({data});
    },
    deleteInvoice(id) {
      this.$store.dispatch('deleteInvoice', id)
        .then((response) => EventBus.$emit('invoiceDeleted', response));
    }
  }
}
</script>

<style>

</style>