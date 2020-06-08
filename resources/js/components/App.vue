<template>
  <div>
    <navigation></navigation>
    <router-view></router-view>
  </div>
</template>

<script>
import axios from '@/axios';
import { mapGetters } from 'vuex';

import Navigation from './Partials/Navigation';

export default {
  components: {
    Navigation,
  },
  mounted() {
    this.fetchUserOrLogin();
  },
  methods: {
    fetchUserOrLogin() {
      this.$store.dispatch('fetchUser');
    }
  },
  ...mapGetters([
    'user'
  ])
}
</script>

<style>

</style>