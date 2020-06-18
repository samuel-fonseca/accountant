<template>
  <b-row class="justify-content-center">


    <b-col cols="12">
      <b-row class="d-flex justify-content-between pb-3 mb-3">
        <b-col cols="8">
          <h3>Clients</h3>
        </b-col>
        <b-col cols="4">
          <b-button variant="warning" block to="/clients/create">Add</b-button>
        </b-col>
      </b-row>

      <b-alert variant="info" v-show="hasClients">No clients have been created yet. Start by adding a new client</b-alert>
    </b-col>
    
    <b-col>
      <view-all></view-all>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import AllClients from './Partial/TableView';

export default {
  components: {
    'view-all': AllClients
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