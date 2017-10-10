<template>
  <section>
    <h1>Delete Id</h1>
    <p>Bye Bye...</p>
    <router-link to="/setting">setting</router-link>
    <button @click="deleteId">Delete</button>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>

<script>
  export default {
    methods: {
      deleteId() {
        console.log('good by');
      }
    }
  }
</script>