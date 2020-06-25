<template>
  <div>
    <navigation></navigation>
    <router-view></router-view>

    <!-- <b-container fluid v-if="authenticated">

      <b-row class="flex-xl-nowrap2">

        <b-col cols="12" md="3" xl="3" class="bd-sidebar border-bottom-0 border-right bg-white">
          <sidebar-navigation></sidebar-navigation>
        </b-col>

        <b-col cols="12" md="9" xl="8" class="bd-content pb-md-3 pl-md-5">
          <router-view></router-view>
        </b-col>

      </b-row>
    </b-container>

    <router-view v-else></router-view> -->

  </div>
</template>

<script>
import axios from '@/axios';
import { mapGetters } from 'vuex';

import Navigation from '@components/Navigation';
import SidebarNavigation from '@components/Sidebar';

export default {
  components: {
    Navigation, SidebarNavigation
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
    'user',
    'authenticated'
  ])
}
</script>
