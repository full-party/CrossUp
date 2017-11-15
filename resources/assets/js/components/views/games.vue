<template>
  <section>
    <h1>ゲーム選択</h1>
    <ul>
      <li v-for="game in games">
        <div @click="setGame(game)">
          <img v-bind:src="game.logo" alt="game logo">
        </div>
      </li>
    </ul>
  </section>
</template>

<style scoped>
  h1 {
    padding-left: 10px;
  }
  ul {
    list-style: none;
    padding: 0;
  }
  li {
    display: inline-block;
    width: 50%;
  }
  img {
    object-fit: contain;
    width: 100%;
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