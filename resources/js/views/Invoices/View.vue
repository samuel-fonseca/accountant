<template>
  <b-container>
    <div class="alert alert-danger" v-if="error">
      <h2>{{ error }}</h2>
      <hr />
      <p class="alert-text">Go back to <b-button variant="link" to="/invoices">invoice home</b-button></p>
    </div>

    <b-overlay :show="loading">
      <b-card v-if="invoice && !error">
        <template v-slot:header>
          <b-button variant="light" class="mr-4" to="/invoices">
            <b-icon-arrow-left-circle-fill></b-icon-arrow-left-circle-fill>
            Go back
          </b-button>

          Invoice for {{ invoice.client.display_name }}
        </template>
        <b-container>
          <view-invoice :invoice="invoice"></view-invoice>
        </b-container>
      </b-card>
    </b-overlay>
  </b-container>
</template>

<script>
import ViewInvoice from '@components/Invoices/View';
import EventBus from '@/vue/event-bus';

export default {
  components: {
    ViewInvoice
  },
  data() {
    return {
      loading: true,
      id: '',
      invoice: {},
      error: null
    }
  },
  mounted() {
    this.id = this.$route.params.id;
    console.log(this.id);

    this.fetchInvoice();
    EventBus.$on('invoiceDeleted', () => this.$router.push('/invoices'));
  },
  methods: {
    fetchInvoice() {
      this.$store.dispatch('fetchInvoice', this.id)
        .then(response => {
          this.invoice = response.data;

          if (this.invoice.client == null) {
            this.error = 'Client information could not be found...';
          }

          console.log(response);
        })
        .catch(err => {
          console.log(err);
          let code = err.response.status;
          if (code === 404) {
            this.error = 'Invoice could not be found.'
          } else if (code === 401) {
            this.error = 'Unauthorized.'
          } else {
            this.error = 'Could not load invoice at this time. Try again later.'
          }
        })
        .finally(() => this.loading = false);
    }
  }

}
</script>

<style>

</style>