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
    
    <b-col>
      <div class="alert alert-info" v-if="!hasClients">No clients have been created yet. Start by adding a new client</div>
      <table-view v-else :loading="loading"></table-view>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import AllClients from '@components/Clients/TableView';

export default {
  mounted() {
    this.$store.dispatch('fetchClients')
      .finally(() => this.loading = false);
  },
  components: {
    'table-view': AllClients
  },
  data() {
    return {
      loading: true,
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