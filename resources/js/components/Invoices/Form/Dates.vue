<template>
  <div id="invoice-dates-selection" class="mb-4">
    <b-row>
      <b-col cols="6">
        <b-form-group label="Invoice Date">
          <b-form-datepicker id="invoiced_at" v-model="invoice.invoiced_at" class="mb-2"></b-form-datepicker>
        </b-form-group>
      </b-col>
      <b-col cols="6">
        <b-form-group label="Invoice Due On">
          <b-form-datepicker :min="invoice.invoiced_at" id="due_at" v-model="invoice.due_at" class="mb-2"></b-form-datepicker>
        </b-form-group>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  props: {
    invoice: Object
  }
}
</script>

<style>

</style>