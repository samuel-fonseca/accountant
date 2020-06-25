<template>
  <div id="invoice-line-items">
    <b-table-simple small responsive striped bordered outlined hover>
      <b-thead>
        <b-tr>
          <b-th>Description</b-th>
          <b-th>Quantity</b-th>
          <b-th>Rate</b-th>
          <b-th>Amount</b-th>
          <b-th></b-th>
        </b-tr>
      </b-thead>
      <b-tbody>
        <b-tr v-for="(item, index) in invoice.line_items" :key="index">
          <b-td>
            <b-form-group>
              <b-form-textarea size="sm" v-model="item.description" name="item.description[]" cols="75" rows="1" required></b-form-textarea>
            </b-form-group>
          </b-td>
          <b-td>
            <b-form-group>
              <b-input size="sm" v-model="item.quantity" type="number" step="1.0" name="item.quantity[]" required></b-input>
            </b-form-group>
          </b-td>
          <b-td>
            <b-input-group size="sm" prepend="$">
              <b-input size="sm" v-model="item.rate" type="number" step=".01" name="item.rate[]" required></b-input>
            </b-input-group>
          </b-td>
          <b-td>
            {{ item.quantity * item.rate | toUSD }}
          </b-td>
          <b-td>
            <b-button variant="outline-danger" size="sm" pill @click="removeLineItem(index)"><b-icon-x></b-icon-x></b-button>
          </b-td>
        </b-tr>
      </b-tbody>
    </b-table-simple>

    <b-button pill variant="dark" size="sm" @click.prevent="addLineItem"><b-icon-plus-circle></b-icon-plus-circle> Line Item</b-button>
  </div>
</template>

<script>
export default {
  props: {
    invoice: Object
  },
  methods: {
    addLineItem() {
      this.invoice.line_items.push({
        description: '', quantity: '', rate: '', amount: ''
      })
    },
    removeLineItem(index) {
      this.invoice.line_items.splice(index, 1)
    },
  }
}
</script>

<style>

</style>