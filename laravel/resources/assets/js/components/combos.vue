<template>
  <section>
    <h1>Combo List</h1>
    <router-link to="/games">Select to games</router-link>
    <ul>
      <li v-for="combo in combos">
        <p>{{combo.damage}}</p>
        <router-link :to="'/combos/' + combo.id">{{combo.title}}</router-link>
      </li>
    </ul>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>

<script>
  export default {
    created() {
        this.getCombos()
      },
    data() {
      return {
          combos: []
      }
    },
    methods: {
      getCombos() {
        axios.get('/api/comboList')
        .then(res =>  {
          this.combos = res.data
        })
      }
    }
  }
</script>