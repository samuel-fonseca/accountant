<template>
  <b-container class="py-5">
    <b-row>
      <b-col>

        <b-card class="shadow-sm border-0">

          <h2>New User Registration</h2>

          <hr />

          <b-form @submit="register">

            <b-row>
              <b-col>
                <b-form-group
                  id="name-label"
                  label="Name"
                  label-for="name"
                >
                  <b-form-input
                    id="name"
                    v-model="account.name"
                    type="text"
                    required
                    placeholder="Enter name"
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>

            <b-row>
              <b-col>
                <b-form-group
                  id="email-label"
                  label="Email address"
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
              </b-col>
            </b-row>

            <b-row>
              <b-col sm="12" md="6">
                <b-form-group
                  id="password-label"
                  label="Password"
                  label-for="password"
                >
                  <b-form-input
                    id="password"
                    v-model="account.password"
                    type="email"
                    required
                    placeholder="Enter password"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col sm="12" md="6">
                <b-form-group
                  id="password-label"
                  label="Confirm Password"
                  label-for="password_confirmation"
                >
                  <b-form-input
                    id="password_confirmation"
                    v-model="account.password_confirmation"
                    type="password"
                    required
                    placeholder="Enter password"
                  ></b-form-input>
                </b-form-group>
              </b-col>
            </b-row>

            <b-button variant="primary">Register</b-button> <small class="text-muted">Already have an account? <router-link to="/login">Login to your account.</router-link></small>

          </b-form>
        </b-card>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      account: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }
    }
  },
  methods: {
    register() {
      return '';
    }
  }
}
</script>

<style>

</style>