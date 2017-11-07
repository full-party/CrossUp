<template>
  <section>
    <h1>Select Games</h1>
    <ul>
      <li v-for="game in games">
        <span @click="setGame(game)">{{game.name}}</span>
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
      },
      setGame(rawGame) {
        const game = {
            id: rawGame.id,
            name: rawGame.name,
            logo: rawGame.logo,
        };
        this.$store.dispatch('setGame', game);
        this.$router.push('combos');
      }
    }
  }
</script>