<template>
  <b-card no-body>

    <b-table bordered striped responsive :fields="table.fields" :items="invoices"></b-table>

  </b-card>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data() {
    return {
      table: {
        fields: ['invoice_number', 'client.firstname', 'client.lastname', 'client.company', 'message', 'discount', 'total', 'invoiced_at', 'due_at', 'created_at']
      }
    }
  },
  computed: {
    ...mapGetters(['invoices'])
  }
}
</script>

<style>

</style>