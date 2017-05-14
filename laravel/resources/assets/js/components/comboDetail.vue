<template>
  <section>
    <h1>Combo Detail</h1>
    <p>{{ $route.params.id }}</p>
    <router-link to="/combos">back combo list</router-link>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>