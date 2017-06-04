<template>
  <section>
    <h1>Select Games</h1>
    <ul>
      <li v-for="game in games">
        <router-link to="/combos/">{{game.name}}</router-link>
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
        this.getGames()
      },
    data() {
      return {
        games: [],
      }
    },
    methods: {
      getGames() {
        axios.get('/api/games')
        .then(res =>  {
          this.games = res.data.data;
        })
      }
    }
  }
</script>