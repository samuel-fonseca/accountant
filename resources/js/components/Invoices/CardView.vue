<template>
  <b-row>
    <b-col cols="12">
      <b-card-group columns>

        <b-card v-for="invoice in invoiceList"
          :key="invoice.id"
          no-body>
          <template v-slot:header v-if="invoice.client">
            <h5>{{invoice.client.firstname}} {{invoice.client.lastname}}</h5>
            <h6 class="text-muted">Invoice # {{invoice.invoice_number}}</h6>
          </template>
          <b-card-body v-if="invoice.client">
            <p>Due: {{ totalDue(invoice) | toUSD }}</p>
            <p>
              <span class="text-muted">Bill To</span><br />
              {{ invoice.client.address }}<br />
              {{ invoice.client.city }}, {{ invoice.client.state }} {{ invoice.client.zip }}<br />
              {{ invoice.client.country }}
            </p>
          </b-card-body>

          <b-list-group flush>
            <b-list-group-item href="#" @click.prevent="receivePayment(invoice.id)">Receive Payment</b-list-group-item>
            <b-list-group-item :to="`/invoices/${invoice.id}/edit`">Edit</b-list-group-item>
            <b-list-group-item href="#" @click.prevent="deleteInvoice(invoice.id)">Delete</b-list-group-item>
          </b-list-group>
        </b-card>

      </b-card-group>
    </b-col>
    <b-col cols="12">
      <b-button size="lg" block variant="light" @click="totalViewIncrease()" class="btn-hover-shadow text-muted">View More</b-button>
    </b-col>
  </b-row>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      total_view: 25
    }
  },
  props: {
    loading: Boolean
  },
  methods: {
    totalDue(invoice) {
      let payments = 0;
      if (invoice.payments) {
        invoice.payments.forEach(p => payments += p.amount);
      }

      return invoice.total - payments;
    },
    deleteInvoice(id) {
      this.$store.dispatch('deleteInvoice');
    },
    totalViewIncrease() {
      if (this.total_view >= this.invoices.length) return;
      
      this.total_view += 25;
    },
  },
  computed: {
    invoiceList() {
      let invoices = this.invoices.slice(0, this.total_view);

      return invoices;
    },
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>