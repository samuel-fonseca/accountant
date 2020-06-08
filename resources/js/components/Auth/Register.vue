<template>
  <b-container>
    <b-row>
      <b-col>

        <b-form @submit="login">

          <b-form-group
            id="username-label"
            label="Email address:"
            label-for="username"
            description="We'll never share your email with anyone else."
          >
            <b-form-input
              id="username"
              v-model="account.username"
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
              type="email"
              required
              placeholder="Enter password"
            ></b-form-input>
          </b-form-group>

        </b-form>

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
        username: '',
        password: '',
      }
    }
  },
  methods: {
    login() {
      return '';
    }
  }
}
</script>

<style>

</style>