<template>
  <b-card no-body class="my-4">

    <b-row class="d-flex justify-content-between m-3">
      <b-col cols="8">
        <h3>Clients</h3>
      </b-col>
      <b-col cols="4">
        <b-button variant="warning" block to="/clients/create">Add</b-button>
      </b-col>
    </b-row>

    <b-card-body :show="!hasClients">
      <b-alert variant="info">No clients have been created yet. Start by adding a new client</b-alert>
    </b-card-body>

    <b-table responsive v-if="hasClients" :items="clients" :fields="table.fields">

      <template v-slot:cell(actions)="row">
        <b-button variant="outline-warning" size="sm" @click="updateClient(row.index)" class="mr-1">
          <b-icon-pencil-square></b-icon-pencil-square>
        </b-button>
        <b-button variant="outline-danger" size="sm" @click="deleteClient(row.index)">
          <b-icon-trash></b-icon-trash>
        </b-button>
      </template>

    </b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      table: {
        fields: [{
          key: 'actions'
        }, {
          key: 'id',
          sortable: false
        }, {
          key: 'firstname',
          sortable: false
        }, {
          key: 'lastname',
          sortable: true
        }, {
          key: 'email',
          sortable: true
        }, {
          key: 'phone',
          sortable: false
        }, {
          key: 'address',
          sortable: true
        }, {
          key: 'city',
          sortable: false
        }, {
          key: 'state',
          sortable: false
        }, {
          key: 'zip',
          sortable: false
        }, {
          key: 'created_at',
          sortable: false
        }],
      }
    }
  },
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