<template>
  <b-card class="my-4">
    
    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Clients Overview</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="dark" block>Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasClients">No Clients logged yet. Start by adding a new expense</b-alert>

    <template v-if="hasClients">
      <b-badge>{{ clientsLength }} Clients</b-badge>
      
    </template>

    <b-table v-if="hasClients">
      <b-tbody></b-tbody>
    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    this.$store.dispatch('fetchClients');
  },
  computed: {
    clientsLength() {
      return this.clients.length
    },
    hasClients() {
      return this.clients.length > 0;
    },
    ...mapGetters(['clients'])
  }
}
</script>

<style>

</style>