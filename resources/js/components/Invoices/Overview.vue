<template>
  <b-card title="Invoice Overviews">
    <canvas id="new-invoice" width="100%"></canvas>
  </b-card>
</template>

<script>
import { mapGetters } from 'vuex';
import Chart from 'chart.js';

export default {
  mounted() {
    let chart = new Chart;
  },
  computed: {
    ...mapGetters([
      'invoices'
    ])
  }
}
</script>

<style>

</style>