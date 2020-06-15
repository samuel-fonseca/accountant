<template>
  <div>
    <navigation></navigation>

    <!-- <transition enter-active-class="animated fadeIn animate__faster"> -->
      <router-view></router-view>
    <!-- </transition> -->
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
