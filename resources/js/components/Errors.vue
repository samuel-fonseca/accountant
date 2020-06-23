<template>
  <div class="alert alert-danger" v-if="hasErrors">
    <h6>{{ error.message }}</h6>
    <template v-if="error.errors">
      <hr />
      <ul>
        <li v-for="(e, i) in error.errors" :key="i">
          {{ e[0] }}
        </li>
      </ul>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    error: Object|null
  },
  computed: {
    hasErrors() {
      if (this.error)
        return Object.keys(this.error).length > 0;

      return false;
    },
  },
}
</script>

<style>

</style>