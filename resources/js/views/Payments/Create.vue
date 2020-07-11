<template>
  <b-container>
    <receive-payment :client="client" :invoices="client.invoices" :payments="client.payments"></receive-payment>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex';
import ReceivePayment from '@components/Payments/Receive';

export default {
  props: {
    ReceivePayment
  },
  mounted() {
    this.$store.dispatch('fetchClient', this.$route.params.id)
      .then(response => this.client = response.data)
      .finally(() => this.loading = false);
  },
  data() {
    return {
      loading: true,
      client: {},
      invoices: [],
      payments: [],
    }
  }
}
</script>

<style>

</style>