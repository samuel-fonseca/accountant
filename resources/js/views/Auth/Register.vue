<template>
  <b-container class="py-5">
    <b-row class="justify-content-center">
      <b-col sm="12" md="10" lg="8">

        <b-card header="New User Registration">

          <b-form @submit.prevent="register">

            <b-row>
              <b-col sm="12" md="6">
                <b-form-group
                  id="firstname-label"
                  label="First Name"
                  label-for="firstname">
                  <b-form-input
                    id="firstname"
                    v-model="account.firstname"
                    type="text"
                    required
                    placeholder="Enter your first name"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col sm="12" md="6">
                <b-form-group
                  id="lastname-label"
                  label="Last Name"
                  label-for="lastname">
                  <b-form-input
                    id="lastname"
                    v-model="account.lastname"
                    type="text"
                    required
                    placeholder="Enter your last name"
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
                  description="We'll never share your email with anyone else.">
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
                  label-for="password">
                  <b-form-input
                    id="password"
                    v-model="account.password"
                    type="password"
                    required
                    placeholder="Enter password"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col sm="12" md="6">
                <b-form-group
                  id="password-confirmation-label"
                  label="Confirm Password"
                  label-for="password_confirmation">
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

            <hr />

            <b-row>
              <b-col cols="12">
                <b-form-group
                  id="address-label"
                  label="Address"
                  label-for="address">
                  <b-form-input
                    id="address"
                    v-model="account.address"
                    type="text"
                    required
                    placeholder="Address Line 1"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col cols="12">
                <b-form-group
                  id="city-label"
                  label="City"
                  label-for="city">
                  <b-form-input
                    id="city"
                    v-model="account.city"
                    type="text"
                    required
                    placeholder="City"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col cols="12" md="6" lg="8">
                <b-form-group
                  id="state-label"
                  label="State"
                  label-for="state">
                  <b-form-select
                    id="state"
                    v-model="account.state"
                    :options="states"
                    required>
                    <template v-slot:first>
                      <option :value="null" disabled>-- Select State --</option>
                    </template>
                  </b-form-select>
                </b-form-group>
              </b-col>
              <b-col cols="12" md="6" lg="4">
                <b-form-group
                  id="zip-label"
                  label="Zip"
                  label-for="zip">
                  <b-form-input
                    id="zip"
                    v-model="account.zip"
                    type="text"
                    required
                    placeholder="Zip"
                  ></b-form-input>
                </b-form-group>
              </b-col>
              <b-col cols="12">
                <b-form-group
                  id="country-label"
                  label="Country"
                  label-for="country">
                  <b-form-select
                    id="country"
                    v-model="account.country"
                    :options="countries"
                    required>
                    <template v-slot:first>
                      <option :value="null" disabled>-- Select Country --</option>
                    </template>
                  </b-form-select>
                </b-form-group>
              </b-col>
            </b-row>

            <b-form-checkbox
              class="mb-4"
              v-model="billingSame"
              :value="true">
              Billing address same as above
            </b-form-checkbox>

            <template v-if="!billingSame">
              <b-row>
                <b-col cols="12">
                  <b-form-group
                    id="billing-address-label"
                    label="Billing Address"
                    label-for="billing_address">
                    <b-form-input
                      id="billing_address"
                      v-model="account.billing_address"
                      type="text"
                      :required="!billingSame"
                      placeholder="Billing Address"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12">
                  <b-form-group
                    id="billing-city-label"
                    label="Billing City"
                    label-for="billing_city">
                    <b-form-input
                      id="billing_city"
                      v-model="account.billing_city"
                      type="text"
                      :required="!billingSame"
                      placeholder="Billing City"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6" lg="8">
                  <b-form-group
                    id="billing-state-label"
                    label="Billing State"
                    label-for="billing_state">
                    <b-form-select
                      id="billing_state"
                      v-model="account.billing_state"
                      :options="states"
                      :required="!billingSame">
                      <template v-slot:first>
                        <option :value="null" disabled>-- Select Billing State --</option>
                      </template>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <b-col cols="12" md="6" lg="4">
                  <b-form-group
                    id="billing-zip-label"
                    label="Billing Zip"
                    label-for="billing_zip">
                    <b-form-input
                      id="billing_zip"
                      v-model="account.billing_zip"
                      type="text"
                      :required="!billingSame"
                      placeholder="Zip"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
                <b-col cols="12">
                  <b-form-group
                    id="country-label"
                    label="Billing Country"
                    label-for="country">
                    <b-form-select
                      id="country"
                      v-model="account.country"
                      :options="countries"
                      required>
                      <template v-slot:first>
                        <option :value="null" disabled>-- Select Billing Country --</option>
                      </template>
                    </b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
            </template>

            <display-error :error="error"></display-error>

            <b-button :disabled="loading" type="submit" variant="primary">
              <b-icon-circle-fill v-show="loading" animation="throb"></b-icon-circle-fill>
              Register
            </b-button>
            <small class="text-muted">Already have an account? <router-link to="/login">Login to your account.</router-link></small>

          </b-form>
        </b-card>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import StateJSON from '@/data/states';
import CountryJSON from '@/data/countries';

export default {
  data() {
    return {
      states: StateJSON,
      countries: CountryJSON,
      loading: false,
      billingSame: true,
      error: null,
      account: {
        fistname: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: '',
        address: null,
        city: null,
        state: null,
        zip: null,
        billing_address: null,
        billing_city: null,
        billing_state: null,
        billing_zip: null,
      }
    }
  },
  methods: {
    register() {
      this.loading = true;
      this.error = null;
      this.$store.dispatch('registerUser', this.account)
        .then(() => {
          this.$router.push({ name: 'dashboard' });
        })
        .catch(err => {
          console.error(err);
          this.error.message = err.response.data.message;
          this.error.errors = err.response.data.errors;
        })
        .finally(() => this.loading = false);
    }
  }
}
</script>

<style>

</style>