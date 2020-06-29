<template>
  <b-overlay :show="loading">
    <b-card no-body header="Clients">

      <b-card-body>
        <b-input-group>
          <b-form-input v-model="search" type="text" placeholder="Search Client"></b-form-input>
          <template v-slot:append>
            <b-button variant="light" @click.prevent="search = ''">
              <b-icon-x></b-icon-x>
            </b-button>
          </template>
        </b-input-group>
      </b-card-body>

      <b-list-group flush class="scrollable-list">
        <b-list-group-item v-for="client in curatedClientList" :key="client.id" href="#" @click="selectClient(client)">
          {{ client.display_name }}
        </b-list-group-item>
      </b-list-group>
    </b-card>
  </b-overlay>
</template>

<script>
import { mapGetters } from 'vuex';
import EventBus from '@/vue/event-bus';

export default {
  data() {
    return {
      search: '',
      selectedClient: null,
    }
  },
  props: {
    loading: Boolean
  },
  methods: {
    selectClient(client) {
      if (this.selectedClient === client.id) return;

      this.selectedClient = client.id;
      EventBus.$emit('clientSelected', client)
    }
  },
  computed: {
    curatedClientList() {
      if (this.search !== '' && this.search !== null) {
        return this.clients.filter(c => c.display_name.toLowerCase().includes(this.search.toLowerCase()));
      }

      return this.clients;
    },
    ...mapGetters(['clients'])
  }
}
</script>

<style>
.scrollable-list {
  max-height: 80vh;
  overflow-y: auto;
}
</style>