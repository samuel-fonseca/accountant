<template>
  
</template>

<script>
export default {
  mounted() {
    axios.get('https://raw.githubusercontent.com/samuel-fonseca/accountant/master/README.md')
      .then(res => {
        this.contents = res.data;
      })
      .catch(err => {
        console.error(err);
      });
  }
}
</script>

<style>

</style>