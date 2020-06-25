<template>
  <b-navbar sticky toggleable="md" type="light" variant="light" class="shadow">
    <b-navbar-brand to="dashboard">Accountant</b-navbar-brand>
    
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav v-if="loggedIn">
        <b-nav-item to="/dashboard">Dashboard</b-nav-item>
        <b-nav-item to="/clients">Clients</b-nav-item>
        <b-nav-item to="/invoices">Invoices</b-nav-item>
        <b-nav-item to="/expenses">Expenses</b-nav-item>
        <b-nav-item to="/incomes">Income</b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto" v-if="loggedIn">
        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template v-slot:button-content>
            <b-icon-person></b-icon-person>
            {{ user.firstname }}
          </template>
          <b-dropdown-item to="/account">Profile</b-dropdown-item>
          <b-dropdown-item href="#" @click.prevent="logout">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto" v-else>
        <b-nav-item to="/login">Login</b-nav-item>
        <b-nav-item to="/register">Register</b-nav-item>
      </b-navbar-nav>
      
    </b-collapse>
  </b-navbar>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  methods: {
    logout() {
      this.$store.dispatch('logoutUser')
        .finally(() => {
          this.$router.push({ name: 'login' });
        });
    }
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
    loggedIn() {
      return Object.keys(this.user).length > 0;
    },
    // ...mapGetters(['user'])
  }
}
</script>

<style>

</style>