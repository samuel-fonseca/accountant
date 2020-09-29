<template>
  <b-row class="justify-content-center">
    <b-col cols="12">
      <b-row class="d-flex justify-content-between pb-3 mb-3">
        <b-col cols="8">
          <h3>Clients</h3>
        </b-col>
        <b-col cols="4">
          <b-dropdown variant="dark" block class="shadow rounded-pill">
            <template v-slot:button-content>
              <b-icon-plus-circle class="mr-2"></b-icon-plus-circle>
              Add
            </template>
            <b-dropdown-item :to="{ name: 'clients.create' }">Add Client</b-dropdown-item>
            <b-dropdown-item v-if="clientSelected" :to="{ name: 'invoices.create', query: {client_id: clientSelected.id} }">Add Invoice for {{ clientSelected.display_name }}</b-dropdown-item>
          </b-dropdown>
        </b-col>
      </b-row>
    </b-col>

    <b-col cols="12" class="my-4" v-if="hasClients">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active">
          <input type="radio" @click.prevent="view = 'list'" v-model="view" checked> <b-icon-card-list></b-icon-card-list>
        </label>
        <label class="btn btn-secondary">
          <input type="radio" @click.prevent="view = 'table'" v-model="view"> <b-icon-table></b-icon-table>
        </label>
      </div>
    </b-col>
    
    <b-col cols="12">
      <b-overlay :show="loading">
        <div class="alert alert-info" v-if="!hasClients && !loading">No clients have been created yet. Start by adding a new client</div>
        <template v-else>
          <!-- Table view -->
          <b-row v-if="view === 'table'">
            <b-col cols="12">
              <table-view :loading="loading" :clients="clients"></table-view>
            </b-col>
          </b-row>
          <!-- List view -->
          <b-row v-else>
            <b-col md="4" lg="3" class="mb-4">
              <list-view :loading="loading"></list-view>
            </b-col>
            <b-col md="8" lg="9" class="mb-4">
              <client-view :loading="loading" :client.sync="clientSelected"></client-view>
            </b-col>
          </b-row>
        </template>
      </b-overlay>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import EventBus from '@/vue/event-bus';
import AllClients from '@components/Clients/TableView';
import ListView from '@components/Clients/ListView';
import TableView from '@components/Clients/TableView';
import ClientView from '@components/Clients/ClientView';

export default {
  mounted() {
    this.$store.dispatch('fetchClients')
      .finally(() => {
        this.clientSelected = this.clients[0];
        this.loading = false
      });

    EventBus.$on('clientSelected', (client) => this.clientSelected = client);
  },
  components: {
    ListView,
    TableView,
    ClientView
  },
  data() {
    return {
      loading: true,
      clientSelected: {},
      view: 'list'
    }
  },
  computed: {
    hasClients() {
      return this.clients.length > 0;
    },
    ...mapGetters(['clients'])
  }
}
</script>

<style>

</style>