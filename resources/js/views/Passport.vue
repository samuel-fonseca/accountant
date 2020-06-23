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
import AuthorizedClients from '@components/passport/AuthorizedClients';
import Clients from '@components/passport/Clients';
import PersonalAccessTokens from '@components/passport/PersonalAccessTokens';

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