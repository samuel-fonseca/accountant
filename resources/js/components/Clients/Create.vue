<template>
  <b-container class="my-5">
    <b-row>
      <b-col>
        <b-card class="border-0 shadow-sm">
          <b-form @submit.prevent="newClient">

            <h4>New Client</h4>
            <hr />

            <b-row>
              <b-col cols="12">
                <h5><b-icon-person-plus></b-icon-person-plus> Name</h5>
              </b-col>
              <b-col cols="6">
                <b-form-group label="First Name">
                  <b-input v-model="client.firstname" name="firstname" required></b-input>
                </b-form-group>
              </b-col>
              <b-col cols="6">
                <b-form-group label="Last Name">
                  <b-input v-model="client.lastname" name="lastname" required></b-input>
                </b-form-group>
              </b-col>
            </b-row>

            <b-row>
              <b-col cols="12">
                <h5><b-icon-phone></b-icon-phone> Contact</h5>
              </b-col>
              <b-col cols="6">
                <b-form-group label="Phone Number">
                  <b-input v-model="client.phone" name="phone" required></b-input>
                </b-form-group>
              </b-col>
              <b-col cols="6">
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
                  <b-form-select v-model="client.state" name="state" :options="states" required></b-form-select>
                </b-form-group>
              </b-col>
              <b-col cols="6">
                <b-form-group label="Zip">
                  <b-input v-model="client.zip" name="zip" required></b-input>
                </b-form-group>
              </b-col>
            </b-row>

            <b-button type="submit" variant="primary">Save</b-button>
            
          </b-form>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import statesJson from '@/data/states';

export default {
  data() {
    return {
      states: statesJson,
      client: {
        firstname: '',
        lastname: '',
        phone: '',
        email: '',
        address: '',
        city: '',
        state: '',
        zip: '',
      }
    }
  },
  methods: {
    newClient() {
      if (this.client.id)
        this.$store.dispatch('updateClient', this.client);
      else
        this.$store.dispatch('createClient', this.client)
          .catch(err => {
            console.error(err);
            alert('Could not save client right now. Try again later');
          })
          .finally(() => {
            this.$store.push({ name: 'clients' })
          });
    }
  }
}
</script>

<style>

</style>