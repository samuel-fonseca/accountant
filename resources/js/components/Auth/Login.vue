<template>
  <b-container class="py-5">
    <b-row class="justify-content-center">
      <b-col sm="12" md="10" lg="6">

        <b-card class="shadow-sm border-0">
          
          <h2>Account Login</h2>

          <hr />

          <b-form method="post" @submit.prevent="login">

            <b-form-group
              id="email-label"
              label="Email address:"
              label-for="email"
              description="We'll never share your email with anyone else."
            >
              <b-form-input
                id="email"
                v-model="account.email"
                type="email"
                required
                placeholder="Enter email"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="password-label"
              label="Password"
              label-for="password"
            >
              <b-form-input
                id="password"
                v-model="account.password"
                type="password"
                required
                placeholder="Enter password"
              ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Login</b-button>
            <b-button size="sm" variant="link" to="/register">Register for a new account</b-button>

          </b-form>
        </b-card>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  mounted() {
    if (localStorage.token) {
      this.$router.push({ name: 'dashboard' });
    }
  },
  data() {
    return {
      loading: false,
      account: {
        email: '',
        password: '',
      }
    }
  },
  methods: {
    login() {
      this.$store.dispatch('loginUser', {
        email: this.account.email,
        password: this.account.password
      })
      .finally(() => {
        this.$router.push({ name: 'dashboard' })
      });
    }
  },
  computed: {
    ...mapGetters([
      'token'
    ])
  }
}
</script>

<style>

</style>