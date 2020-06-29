<template>
  <b-row class="justify-content-center">
    <b-col cols="12">
      <b-row class="d-flex justify-content-between pb-3 mb-3">
        <b-col cols="8">
          <h3>Clients</h3>
        </b-col>
        <b-col cols="4">
          <b-button pill variant="dark" block :to="{ name: 'clients.create' }" class="shadow">
            <b-icon-plus-circle class="mr-2"></b-icon-plus-circle>
            Add
          </b-button>
        </b-col>
      </b-row>
    </b-col>
    
    <b-col cols="12">
      <div class="alert alert-info" v-if="!hasClients">No clients have been created yet. Start by adding a new client</div>

      <b-row v-else>
        <b-col md="2" lg="3" class="mb-4">
          <list-view :loading="loading"></list-view>
        </b-col>
        <b-col md="10" lg="9" class="mb-4">
          <client-view v-if="clientSelected" :client.sync="client"></client-view>
          <b-alert :show="!clientSelected" variant="info">
            No client selected
          </b-alert>
        </b-col>
      </b-row>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import EventBus from '@/vue/event-bus';
import AllClients from '@components/Clients/TableView';
import ListView from '@components/Clients/ListView';
import ClientView from '@components/Clients/ClientView';

export default {
  mounted() {
    this.$store.dispatch('fetchClients')
      .finally(() => this.loading = false);

    EventBus.$on('clientSelected', () => this.clientSelected = true);
  },
  components: {
    ListView,
    ClientView
  },
  data() {
    return {
      loading: true,
      clientSelected: false,
      client: {},
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