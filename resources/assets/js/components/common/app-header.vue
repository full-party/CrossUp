<template>
  <header>
    <div class="logo">
      Header
    </div>
    <sidebar></sidebar>
  </header>
</template>

<style scoped>
  header {
    top: 0;
    left: 0;
    width: 100%;
    height: 30px;
    background-color: red;
  }
  .logo {
    display: inline-block;
    width: 80px;
    height: 100%;
  }
</style>

<script>
  export default {
    components: {
      sidebar: require('./app-sidebar.vue')
    }
  }
</script>