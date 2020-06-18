<template>
  <b-container class="py-4">
    <b-row>
      <b-col>
        <b-card>
          <h1>Welcome, {{ user.name }}</h1>
          <p>Here's a quick overview of your expenses and incomes</p>
        </b-card>
      </b-col>
    </b-row>
    <b-row>
      <b-col sm="12" md="6">
        <expenses-overview></expenses-overview>
      </b-col>
      <b-col sm="12" md="6">
        <incomes-overview></incomes-overview>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <clients></clients>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex';
import ExpensesOverview from './ExpensesOverview';
import IncomesOverview from './IncomesOverview';
import Clients from '@components/Clients/Partial/TableView';

export default {
  components: {
    ExpensesOverview,
    IncomesOverview,
    Clients,
  },
  computed: {
    ...mapGetters([
      'user'
    ])
  }
}
</script>

<style>

</style>