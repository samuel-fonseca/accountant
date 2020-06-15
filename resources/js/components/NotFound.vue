<template>
  <b-container class="py-5">

    <b-row class="justify-content-center text-center">

      <b-col sm="12" md="10" lg="8">
          
        <h2 class="display-3">
          <span class="text-danger"><b-icon-exclamation-octagon></b-icon-exclamation-octagon> 404</span> Not Found
        </h2>

        <h3 class="display-5">
          <b class="text-danger">{{ currentPath }}</b> cannot be found.
        </h3>

        <hr />

        <b-button size="lg" variant="outline-dark" aria-hidden="true" @click.prevent="goBack">
          <b-icon-arrow-bar-left></b-icon-arrow-bar-left>
          Go Back
        </b-button>
        <b-button size="lg" variant="outline-dark" aria-hidden="true" @click.prevent="goHomeOrDashboard">
          <b-icon-house></b-icon-house>
          Home
        </b-button>

      </b-col>

    </b-row>

  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  methods: {
    goHomeOrDashboard() {
      if (this.authenticated)
        return this.$router.push({ name: 'dashboard' })

      return this.$router.push({ name: 'home' })
    },
    goBack() {
      return this.$router.go(-1)
    }
  },
  computed: {
    currentPath() {
      return this.$route.fullPath
    },
    ...mapGetters(['authenticated'])
  }
}
</script>

<style>

</style>