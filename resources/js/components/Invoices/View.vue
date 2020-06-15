<template>
  <b-card class="my-4">

    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Invoices</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="warning" block :to="{ name: 'invoices.create' }">Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasInvoices">No invoices have been created yet. Start by creating a new invoice.</b-alert>

    <b-table v-if="hasInvoices">
      <b-tbody></b-tbody>
    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    hasInvoices() {
      return this.invoices.length > 0;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>