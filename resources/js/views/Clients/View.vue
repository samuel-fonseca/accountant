<template>
  <b-container fluid>
    <b-row>
      <b-col cols="12">
        <b-overlay :show="loading" rounded="lg" spinner-type="grow">
          <b-card header="Customer Information">
            <h6>
              <b-icon-person></b-icon-person>
              {{ client.firstname }} {{ client.lastname }}
            </h6>
            <h6>
              <b-icon-building></b-icon-building>
              {{ client.company }}
            </h6>
          </b-card>
        </b-overlay>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
      id: null,
      client: {},
    }
  },
  mounted() {
    this.id = this.$route.params.id;

    this.$store.dispatch('fetchClientWithInvoices', this.id)
      .then(response => this.client = response.data)
      .catch(err => console.error(err))
      .finally(() => this.loading = false);
  }
}
</script>

<style>

</style>