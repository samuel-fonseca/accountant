<template>
  <b-container>
    <b-row>
      <b-col>
        <AuthorizedClients />
      </b-col>
      <b-col>
        <Clients />
      </b-col>
      <b-col>
        <PersonalAccessTokens />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import AuthorizedClients from './AuthorizedClients';
import Clients from './Clients';
import PersonalAccessTokens from './PersonalAccessTokens';
export default {
  components: {
    AuthorizedClients,
    Clients,
    PersonalAccessTokens,
  },
}
</script>

<style>

</style>