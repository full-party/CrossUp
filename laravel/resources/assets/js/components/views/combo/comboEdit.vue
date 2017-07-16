<template>
  <section>
    <h1>Combo Edit</h1>
    <p>{{ $route.params.id }}</p>
    <p>
      <p>Damege : {{combo.damage}}</p>
      <p>Stun : {{combo.stun}}</p>
      <p>Memo : {{combo.memo}}</p>
      <p>Character : {{combo.character.name}}</p>
    </p>
    <router-link :to="'/combos/' + $route.params.id">back combo detail</router-link>
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
        this.getCombo();
      },
    data() {
      return {
        combo: {
          character: '',
        },
      }
    },
    methods: {
      getCombo() {
        axios.get('/api/combos/' + this.$route.params.id)
        .then(res =>  {
          this.combo = res.data;
        })
      },
    }
  }
</script>