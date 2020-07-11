<template>
  <b-row>
    <b-col cols="12"><h3>Payment for {{ invoice.client.display_name }}</h3></b-col>
    <b-col sm="12" md="6" lg="8">
      <b-card>
        <b-form>
          <b-form-group label="">
            <b-form-input />
          </b-form-group>
        </b-form>
      </b-card>
    </b-col>
    <b-col sm="12" md="6" lg="4">Invoice Info</b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    this.$store.dispatch('fetchInvoice', this.$route.params.id)
      .then(response => this.invoice = response.data);
  },
  data() {
    return {
      invoice: {}
    }
  },
}
</script>

<style>

</style>