<template>
  <b-row>
    <b-col>
      <view-all :fetch-all="true"></view-all>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';
import ViewInvoices from './View';

export default {
  components: {
    'view-all': ViewInvoices
  },
}
</script>

<style>

</style>