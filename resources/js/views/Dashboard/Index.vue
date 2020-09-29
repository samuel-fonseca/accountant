<template>
  <b-container class="py-4">

    <b-row>
      <b-col>
        <b-card>
          <h1>Welcome {{ user.firstname }}</h1>
          <p>Here's a quick overview of your expenses and incomes</p>
        </b-card>
      </b-col>
    </b-row>

    <b-row>
      <b-col sm="12" md="6">
        <clients-overview></clients-overview>
      </b-col>
      <b-col sm="12" md="6">
        <invoices-overview></invoices-overview>
      </b-col>
    </b-row>

  </b-container>
</template>

<script>
import { mapGetters } from 'vuex';
import ClientsOverview from '@components/Dashboard/ClientsOverview';
import InvoicesOverview from '@components/Dashboard/InvoicesOverview';

export default {
  mounted() {
    // 
  },
  components: {
    ClientsOverview,
    InvoicesOverview,
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