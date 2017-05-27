<template>
  <section>
    <h1>Combo Edit</h1>
    <p>{{ $route.params.id }}</p>
    <router-link :to="'/combos/' + $route.params.id">back combo detail</router-link>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>