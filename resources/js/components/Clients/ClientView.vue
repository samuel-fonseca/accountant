<template>
<div>
  <b-card v-if="client" :header="`${client.display_name}`">
    <b-row class="mb-2">
      <b-col cols="12" md="6">
        <h6>
          <b-icon-person></b-icon-person>
          {{ client.firstname }} {{ client.lastname }}
        </h6>
        <h6>
          <b-icon-building></b-icon-building>
          {{ client.company }}
        </h6>
      </b-col>
      <b-col cols="12" md="6">
        <h6>
          <b-icon-phone></b-icon-phone>
          {{ client.phone }}
        </h6>
        <h6>
          <b-icon-envelope></b-icon-envelope>
          <b-link :href="`mailto:${client.email}`">{{ client.email }}</b-link>
        </h6>
      </b-col>
      <b-col cols="12" md="6">
        <h6 class="text-muted">Bill To</h6>
        <p>
          {{ client.address }}<br />
          {{ client.city }}<br />
          {{ client.state }} {{ client.zip }}<br />
          {{ client.country }}
        </p>
      </b-col>
    </b-row>

    <b-table striped small bordered :busy="loading" :items="invoices" head-variant="dark">
      <template v-slot:table-busy>
        <div class="text-center text-info my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
      <template v-slot:cell(action)="data">
        <b-button size="sm" variant="outline-primary" :to="data.item.action.view">
          <b-icon-eye></b-icon-eye>
        </b-button>
        <b-button size="sm" variant="outline-info" :to="data.item.action.edit">
          <b-icon-pencil-square></b-icon-pencil-square>
        </b-button>
        <b-button size="sm" variant="outline-danger" :to="data.item.action.delete">
          <b-icon-trash></b-icon-trash>
        </b-button>
      </template>
    </b-table>
  </b-card>
  <b-alert v-else>No Customer Select --- start by selecting a customer</b-alert>
</div>
</template>

<script>
import EventBus from '@/vue/event-bus';

export default {
  props: {
    client: Object,
    loading: Boolean
  },
  data() {
    return {
      originalInvoices: [],
      invoiceTableFields: ['number', 'total', 'due', 'action'],
    }
  },
  computed: {
    invoices() {
      if (this.loading) return;

      let invoices = [];
      this.client.invoices.forEach(invoice => {
        invoices.push({
          // _cellVariants: {due: new Date(invoice.due)},
          number: invoice.invoice_number,
          total: this.$options.filters.toUSD(invoice.total),
          due: this.$options.filters.localeDate(invoice.invoiced_at),
          action: `/invoices/${invoice.id}`
        })
      });

      return invoices;
    }
  }
}
</script>

<style>

</style>