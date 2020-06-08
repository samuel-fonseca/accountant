<template>
  <b-card class="border-0 shadow-sm my-4">
    
    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Expenses Overview</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="danger" block>Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasExpenses">No Expenses logged yet. Start by adding a new expense</b-alert>

    <b-table v-if="hasExpenses">
      <b-tbody></b-tbody>
    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    this.$store.dispatch('fetchExpenses');
  },
  computed: {
    hasExpenses() {
      return this.expenses.length > 0;
    },
    ...mapGetters(['expenses'])
  }
}
</script>

<style>

</style>