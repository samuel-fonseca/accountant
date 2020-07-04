<template>
<b-card no-body header="Information" class="sticky-top offset-top">
  <b-card-body>
    Details on open invoices
  </b-card-body>
  <b-list-group flush>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Total Invoices <b-badge variant="success">{{ invoicesDetails.count }}</b-badge>
    </b-list-group-item>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Total Invoiced <b-badge variant="success">{{ invoicesDetails.total | toUSD }}</b-badge>
    </b-list-group-item>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Open Invoices <b-badge variant="info">{{ invoicesDetails.open | toUSD }}</b-badge>
    </b-list-group-item>
    <b-list-group-item v-if="invoicesDetails.overdue" variant="danger" class="d-flex justify-content-between align-items-center">
      Overdue <b-badge variant="danger">{{ invoicesDetails.overdue | toUSD }}</b-badge>
    </b-list-group-item>
  </b-list-group>
</b-card>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      // 
    }
  },
  computed: {
    invoicesDetails() {
      let invoices = {
        count: this.invoices.length,
        total: 0,
        open: 0,
        overdue: 0,
        paid: 0,
      },
      today = new Date();

      this.invoices.forEach(invoice => {
        let due_at = new Date(invoice.due_at);

        invoices.total += invoice.total;

        if (due_at > today) {
          invoices.overdue += invoice.total
        }

        if (this.invoices.payments) {
          // 
        }
      })

      return invoices;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>
.offset-top {
  top: 64px;
}
</style>