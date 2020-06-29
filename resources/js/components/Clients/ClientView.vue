<template>
  <b-overlay :show="loading" rounded="lg" spinner-type="grow">
    <b-card :header="`${client.display_name}`">
      <b-row class="mb-4">
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
          <h6 class="text-muted">Bill To</h6>
          <p>
            {{ client.address }}<br />
            {{ client.city }}<br />
            {{ client.state }} {{ client.zip }}<br />
            {{ client.country }}
          </p>
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
      </b-row>

      <b-table :items="invoices" :fields="['number', 'total', 'due']"></b-table>
    </b-card>
  </b-overlay>
</template>

<script>
import EventBus from '@/vue/event-bus';

export default {
  data() {
    return {
      loading: true,
      originalInvoices: [],
      client: {}
    }
  },
  mounted() {
    EventBus.$on('clientSelected', (client) => {
      this.client = client;
      let id = client.id;

      this.$store.dispatch('fetchClientInvoices', id)
        .then(response => this.originalInvoices = response.data)
        .finally(() => this.loading = false);
    });
  },
  computed: {
    invoices() {
      let invoices = [];
      this.originalInvoices.forEach(invoice => {
        invoices.push({
          number: invoice.invoice_number,
          total: this.$options.filters.toUSD(invoice.total),
          due: this.$options.filters.localeDate(invoice.invoiced_at),
        })
      });

      return invoices;
    }
  }
}
</script>

<style>

</style>