<template>
  <b-card class="border-0 shadow-sm my-4">

    <b-row class="d-flex justify-content-between border-bottom pb-3 mb-3">
      <b-col cols="8">
        <h3>Clients</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="warning" block to="/clients/create">Add</b-button>
      </b-col>
    </b-row>

    <b-alert variant="info" :show="!hasClients">No clients have been created yet. Start by adding a new client</b-alert>

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
    hasClients() {
      return this.clients.length > 0;
    },
    ...mapGetters(['clients'])
  }
}
</script>

<style>

</style>