<template>
  <b-card no-body>
    <b-row class="m-2">
      <b-col sm="7" md="8" lg="6" class="my-1">
        <b-pagination
          v-model="table.pagination.currentPage"
          :total-rows="tableClients.length"
          :per-page="table.pagination.perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>

      <b-col sm="12" md="4" lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="table.filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!table.filter" @click="table.filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>

    <b-table :busy="loading"
      bordered
      striped
      responsive
      foot-clone
      stacked="sm"
      :small="smallTable"
      :fields="table.fields"
      :items="tableClients"
      :current-page="table.pagination.currentPage"
      :per-page="table.pagination.perPage"
      :filter="table.filter">
      <template v-slot:table-busy>
        <div class="text-center text-success my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
    </b-table>

    <b-modal :id="clientModal.id" :title="clientModal.title">
      <!--  -->
    </b-modal>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  props: {
    loading: Boolean,
    smallTable: Boolean,
  },
  data() {
    return {
      table: {
        filter: null,
        fields: [
          {key: 'name', sortable: true},
          {key: 'address', sortable: true}, 
          {key: 'email', sortable: true},
          {key: 'phone', sortable: false},
          {key: 'customer_since', sortable: false}
        ],
        pagination: {
          currentPage: 1,
          perPage: 25
        },
      },
      clientModal: {
        id: 'view-client-details',
        title: '',
        content: '',
      },
    }
  },
  computed: {
    tableClients() {
      let items = [];

      this.clients.forEach(c => {
        items.push({
          name: c.company || `${c.firstname} ${c.lastname}`,
          address: `${c.address} - ${c.city} ${c.state} ${c.state}`,
          phone: c.phone,
          email: c.email,
          customer_since: new Date(c.created_at).toLocaleDateString(),
        })
      })

      return items;
    },
    selectedClient() {},
    ...mapGetters(['clients'])
  }
}
</script>

<style>

</style>