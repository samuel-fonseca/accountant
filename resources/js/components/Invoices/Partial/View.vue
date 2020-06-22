<template>
  <b-container fluid id="view-invoice">
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
          <b-icon-envelope></b-icon-envelope> {{ invoice.client.email }}<br />
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
  </b-container>
</template>

<script>
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
    }
  }
}
</script>

<style>

</style>