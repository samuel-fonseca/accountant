<template>
  <b-container class="py-4">
    <b-row>
      <b-col>
        <b-card class="shadow-sm border-0">
          <h1>Welcome, {{ user.name }}</h1>
          <p>Here's a quick overview of your expenses and incomes</p>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters([
      'user'
    ])
  }
}
</script>

<style>

</style>