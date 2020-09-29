<template>
  <b-card class="my-4">
    
    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Invoices Overview</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="dark" block>Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasInvoices">No Invoices logged yet. Start by adding a new expense</b-alert>

    <template v-if="hasInvoices">
      <b-badge>{{ invoicesLength }} Invoices</b-badge>
      
    </template>

    <b-table v-if="hasInvoices">
      <b-tbody></b-tbody>
    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    this.$store.dispatch('fetchInvoices');
  },
  computed: {
    invoicesLength() {
      return this.invoices.length
    },
    hasInvoices() {
      return this.invoices.length > 0;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>