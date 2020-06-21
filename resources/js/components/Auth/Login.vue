<template>
  <b-container class="py-5">
    <b-row class="justify-content-center">
      <b-col sm="12" md="10" lg="6">

        <b-card header="Account Login">

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

            <div class="alert alert-danger" v-if="error" v-html="error"></div>

            <b-button :disabled="loading" type="submit" variant="primary">
              <b-icon-circle-fill v-show="loading" animation="throb"></b-icon-circle-fill>
              Login
            </b-button>
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
  data() {
    return {
      error: false,
      loading: false,
      account: {
        email: '',
        password: '',
      }
    }
  },
  methods: {
    login() {
      this.loading = true;
      this.error = false;

      this.$store.dispatch('loginUser', {
        email: this.account.email,
        password: this.account.password
      })
      .then(() => this.$router.push({ name: 'dashboard' }))
      .catch(err => {
        console.error(err);
        this.error = err.response.data.message;
      })
      .finally(() => this.loading = false);
    },
  },
  computed: {
    redirectAuth() {
      if (this.authenticated) {
        this.$router.push({ name: 'dashboard' });
      }
    },
    ...mapGetters([
      'authenticated'
    ])
  }
}
</script>

<style>

</style>