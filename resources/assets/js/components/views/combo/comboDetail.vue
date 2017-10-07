<template>
  <section>
    <h1>Combo Detail</h1>
    <p>{{ $route.params.id }}</p>
    <p>
      <p>Damege : {{combo.damage}}</p>
      <p>Stun : {{combo.stun}}</p>
      <p>Memo : {{combo.memo}}</p>
      <p>Character : {{combo.character.name}}</p>
      <p>Meter : {{combo.meter}}</p>
      <p>Recipe</p>
      <ul>
        <li v-for="recipe in combo.recipes">
          {{recipe.move.name}}
        </li>
      </ul>
    </p>
    <p>
      <router-link :to="'/combos/' + $route.params.id + '/edit'">edit combo</router-link>
    </p>
    <p>
      <router-link to="/combos">back combo list</router-link>
    </p>
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