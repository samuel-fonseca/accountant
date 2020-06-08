<template>
  <b-card class="border-0 shadow-sm my-4">
    
    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Incomes Overview</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="success" block>Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasIncomes">No income has been logged yet. Start by adding a new income</b-alert>

    <b-table v-if="hasIncomes">
      <b-tbody></b-tbody>
    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    this.$store.dispatch('fetchIncomes');
  },
  computed: {
    hasIncomes() {
      return this.incomes.length > 0;
    },
    ...mapGetters(['incomes'])
  }
}
</script>

<style>

</style>