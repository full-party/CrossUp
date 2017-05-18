<template>
  <section>
    <h1>Combo Detail</h1>
    <p>{{ $route.params.id }}</p>
    <p>
      <router-link to="/combos">back combo list</router-link>
    </p>
    <p>
      <router-link :to="'/combos/' + $route.params.id + '/edit'">edit combo</router-link>
    </p>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>