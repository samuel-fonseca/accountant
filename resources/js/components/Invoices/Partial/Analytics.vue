<template>
<b-card no-body header="Information">
  <b-card-body>
    Details on open invoices
  </b-card-body>
  <b-list-group flush>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Total Invoices <b-badge variant="success">{{ invoicesDetails.count }}</b-badge>
    </b-list-group-item>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Open Invoices <b-badge variant="info">{{ invoicesDetails.open | toUSD }}</b-badge>
    </b-list-group-item>
    <b-list-group-item class="d-flex justify-content-between align-items-center">
      Overdue <b-badge variant="danger">{{ invoicesDetails.overdue | toUSD }}</b-badge>
    </b-list-group-item>
  </b-list-group>
</b-card>
</template>

<script>
import { mapGetters } from 'vuex'
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
        open: 0,
        overdue: 0,
        paid: 0,
      };

      this.invoices.forEach(invoice => {
        invoices.open += invoice.total;

        if (new Date(invoice.due_at) > new Date()) {
          invoices.overdue += invoice.total
        }

        if (this.invoices.payments) {
          // 
        }
      })

      return invoices;
    },
    overdueInvoices() {
      let count = 0;
      // this.invoices.foreac
    },
    openInvoices() {
      let count = 0;
      this.invoices.forEach(i => count += i.total);

      return count;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>