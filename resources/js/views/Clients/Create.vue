<template>
  <b-card :class="{'no-shadow': inModal}">
    <template v-if="!inModal" v-slot:header>
      New Client
    </template>

    <b-form @submit.prevent="newClient">

      <b-row>
        <b-col cols="12">
          <h5><b-icon-person-plus></b-icon-person-plus> Name</h5>
        </b-col>
        <b-col sm="12" md="6">
          <b-form-group label="First Name">
            <b-input v-model="client.firstname" name="firstname" required></b-input>
          </b-form-group>
        </b-col>
        <b-col sm="12" md="6">
          <b-form-group label="Last Name">
            <b-input v-model="client.lastname" name="lastname" required></b-input>
          </b-form-group>
        </b-col>
        <b-col cols="12">
          <b-form-group label="Company">
            <b-input v-model="client.company" name="company"></b-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <h5><b-icon-phone></b-icon-phone> Contact</h5>
        </b-col>
        <b-col sm="12" md="6">
          <b-form-group label="Phone Number">
            <b-input v-model="client.phone" name="phone" required></b-input>
          </b-form-group>
        </b-col>
        <b-col sm="12" md="6">
          <b-form-group label="Email">
            <b-input v-model="client.email" name="email" required></b-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <h5><b-icon-map></b-icon-map> Address</h5>
        </b-col>
        <b-col cols="12">
          <b-form-group label="Address">
            <b-input v-model="client.address" name="address" required></b-input>
          </b-form-group>
        </b-col>
        <b-col cols="12">
          <b-form-group label="City">
            <b-input v-model="client.city" name="city" required></b-input>
          </b-form-group>
        </b-col>
        <b-col cols="6">
          <b-form-group label="State">
            <b-form-select v-model="client.state" name="state" :options="states" required>
              <template v-slot:first>
                <option :value="null" disabled>--- Select State ---</option>
              </template>
            </b-form-select>
          </b-form-group>
        </b-col>
        <b-col cols="6">
          <b-form-group label="Zip">
            <b-input v-model="client.zip" name="zip" required></b-input>
          </b-form-group>
        </b-col>
        <b-col cols="12">
          <b-form-group label="Country">
            <b-form-select v-model="client.country" name="country" :options="countries" required>
              <template v-slot:first>
                <option :value="null" disabled>--- Select Country ---</option>
              </template>
            </b-form-select>
          </b-form-group>
        </b-col>
      </b-row>

      <hr v-show="!inModal" />

      <b-button v-show="!inModal" :disabled="loading && isValid" block size="lg" type="submit" variant="primary">
        <b-icon-circle-fill v-show="loading" animation="throb"></b-icon-circle-fill>
        Create
      </b-button>
      
    </b-form>
  </b-card>
</template>

<script>
import statesJson from '@/data/states';
import countriesJson from '@/data/countries';
import EventBus from '@/vue/event-bus';

export default {
  mounted() {
    EventBus.$on('create-new-client', () => this.newClient());
  },
  props: {
    inModal: Boolean
  },
  data() {
    return {
      states: statesJson,
      countries: countriesJson,
      loading: false,
      required_fields: ['firstname', 'lastname', 'phone', 'email', 'address', 'city', 'state', 'zip', 'country'],
      client: {
        firstname: '',
        lastname: '',
        company: '',
        phone: '',
        email: '',
        address: '',
        city: '',
        state: null,
        zip: '',
        country: null,
      }
    }
  },
  methods: {
    newClient() {
      this.loading = true;
      let action = this.client.id ? 'updateClient' : 'createClient';

      this.$store.dispatch(action, this.client)
        .then(() => {
          if (!this.inModal)
            this.$router.push({ name: 'clients.home' });
          else
            EventBus.$emit('client-saved');
        })
        .catch(err => {
          console.error(err);
          alert('Could not save client right now. Try again later');
        })
        .finally(() => this.loading = false);
    }
  },
  mounted: {
    isFormValid() {
      let invoice = this.invoice,
          fields = this.required_fields;

      fields.forEach(f => {
        if (invoice[f] === '' || invoice[f] === null || invoice[f] === undefined) {
          return false;
        }
      })

      return true;
    }
  }
}
</script>

<style scoped>
.no-shadow {
  box-shadow: none !important;
}
</style>