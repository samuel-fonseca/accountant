<template>
  <b-container>
    <b-row>
      <b-col>
        <view-all></view-all>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex';
import AllClients from './All';

export default {
  components: {
    'view-all': AllClients
  },
}
</script>

<style>

</style>