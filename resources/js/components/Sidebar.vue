<template>
  <b-nav vertical class="w-25">
    <b-nav-item v-for="(link, i) in links" :key="i" :to="link.url">{{ link.title }}</b-nav-item>
  </b-nav>
</template>

<script>
export default {
  data() {
    return {
      links: [{
        title: 'Dashboard',
        url: '/dashboard',
      }, {
        title: 'Invoices',
        url: '/invoices'
      }, {
        title: 'Clients',
        url: '/clients'
      }],
    }
  },
}
</script>

<style>
.bd-sidebar {
  position: -webkit-sticky;
  position: sticky;
  top: 4rem;
  z-index: 1000;
  height: calc(100vh - 4rem);
}
</style>