<template>
  <b-row class="justify-content-center">

    <b-col cols="12">
      <b-row class="d-flex justify-content-between pb-3 mb-3">
        <b-col cols="8">
          <h3>Invoices</h3>
        </b-col>
        <b-col cols="4">
          <b-button variant="warning" block :to="{ name: 'invoices.create' }">Add</b-button>
        </b-col>
      </b-row>

      <b-alert variant="info" :show="!hasInvoices">No invoices have been created yet. Start by creating a new invoice.</b-alert>
    </b-col>

    <b-col cols="12" class="my-4">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active">
          <input type="radio" @click="toggleView('table')" v-model="view" checked> <b-icon-table></b-icon-table>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" @click="toggleView('cards')" v-model="view"> <b-icon-card-heading></b-icon-card-heading>
        </label>
      </div>
    </b-col>

    <!-- View -->
    <b-col sm="12" md="12" lg="8" class="mb-4">
      <table-view :loading="loading" v-if="view === 'table'" :fetch-all="true"></table-view>
      <card-view :loading="loading" v-if="view === 'cards'" :fetch-all="true"></card-view>
    </b-col>

    <!-- Side -->
    <b-col sm="12" md="12" lg="4">
      <analytics></analytics>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import TableView from '@components/Invoices/TableView';
import CardView from '@components/Invoices/CardView';
import Analytics from '@components/Invoices/Analytics';

export default {
  mounted() {
    this.$store.dispatch('fetchInvoices')
      .finally(() => this.loading = false);
  },
  data() {
    return {
      loading: true,
      view: 'table',
    }
  },
  methods: {
    toggleView(view) {
      this.view = view;
    }
  },
  computed: {
    hasInvoices() {
      return this.invoices.length > 0;
    },
    ...mapGetters(['invoices'])
  },
  components: {
    TableView, CardView, Analytics
  },
}
</script>

<style>

</style>