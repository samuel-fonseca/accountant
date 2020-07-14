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

    <b-table v-if="hasInvoices" striped small bordered :busy="loading" :items="invoices" :fields="invoiceTableFields" head-variant="dark">
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
        <b-button size="sm" variant="outline-danger" @click.prevent="deleteInvoice(data.item.id)">
          <b-icon-trash></b-icon-trash>
        </b-button>
      </template>
    </b-table>
    <b-alert :show="!hasInvoices" v-else variant="light">
      No invoices for this customer. <router-link :to="{ path: '/invoices/create', query: {client_id: this.client.id} }">Create a new invoice</router-link>.
    </b-alert>
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
          id: invoice.id,
          number: invoice.invoice_number,
          total: this.$options.filters.toUSD(invoice.total),
          due: this.$options.filters.localeDate(invoice.invoiced_at),
          action: `/invoices/${invoice.id}`
        })
      });

      return invoices;
    },
    hasInvoices() {
      return this.invoices.length > 0;
    }
  },
  methods: {
    deleteInvoice(id) {
      this.$store.dispatch('deleteInvoice', id)
        .then(() => {
          let index = this.client.invoices.findIndex(i => i.id === id);
          if (index)
            this.client.invoices.splice(index, 1)
        })
        .catch(err => alert(err.response.data.message || "Could not delete invoice at this time..."));
    }
  }
}
</script>

<style>

</style>