<template>
  <div id="select-client">

    <b-row class="mb-5">
      <b-col cols="12">
        <h5>
          <b-icon-person-plus></b-icon-person-plus>
          Client
          <b-button pill size="sm" variant="outline-success" class="ml-4" v-b-modal.create-client-modal>
            <b-icon-plus></b-icon-plus>
          </b-button>
        </h5>
      </b-col>
      <b-col cols="12" class="mb-4">
        <b-form-select v-model="invoice.client_id" name="client_id" :options="selectClientList">
          <template v-slot:first>
            <b-form-select-option :value="null" disabled>-- Please select a client --</b-form-select-option>
          </template>
        </b-form-select>
      </b-col>

      <template v-if="invoice.client_id">
        <b-col sm="12" md="8">
          <h6 class="text-muted">Bill To</h6>
          <p>
            <span v-if="selectedClient.firstname || selectedClient.lastname">{{ selectedClient.firstname }} {{ selectedClient.lastname }}<br /></span>
            <span v-if="selectedClient.company">{{ selectedClient.company }}<br /></span>
            {{ selectedClient.address }}<br />
            {{ selectedClient.city }}, {{ selectedClient.state }} {{ selectedClient.zip }}<br />
            {{ selectedClient.country }}<br />
          </p>
        </b-col>
        <b-col sm="12" md="4">
          <h6 class="text-muted">Contact</h6>
          <p>
            <b-icon-envelope></b-icon-envelope> {{ selectedClient.email }}<br />
            <b-icon-phone></b-icon-phone> {{ selectedClient.phone }}
          </p>
        </b-col>
      </template>
    </b-row>

    <b-modal body-class="p-0" size="lg" scrollable id="create-client-modal" title="New Client" @ok="submitNewClientRequest">
      <create-client :in-modal="true"></create-client>
    </b-modal>
  </div>
</template>

<script>
import EventBus from '@/vue/event-bus';

import CreateClient from '@/views/Clients/Create';
import { mapGetters } from 'vuex';

export default {
  components: {
    CreateClient
  },
  props: {
    invoice: Object,
  },
  mounted() {
    this.fetchClients();
    
    EventBus.$on('client-saved', () => this.fetchClients());
  },
  methods: {
    submitNewClientRequest() {
      EventBus.$emit('create-new-client');
    },
    fetchClients() {
      return this.$store.dispatch('fetchClients');
    },
  },
  computed: {
    selectClientList() {
      let clients = this.clients,
          selectable = [];

      clients.forEach(c => {
        selectable.push({
          text: c.firstname + ' ' + c.lastname,
          value: c.id
        })
      })

      return selectable;
    },
    selectedClient() {
      return this.invoice.client_id ? this.clients.find(c => c.id === this.invoice.client_id) : {};
    },
    ...mapGetters(['clients']),
  },
}
</script>

<style>

</style>