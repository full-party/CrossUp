<template>
  <li>
    <router-link :to="'/combos/' + combo.id">
      <div class="combo__character">
        <img v-bind:src="'/img/character/' + combo.character.image" alt="character image" class="combo__character__image">
        <p class="combo__character__name">{{combo.character.name}}</p>
      </div>
      <p class="combo__damage">ダメージ : <span class="combo__text brand-text">{{combo.damage}}</span></p>
      <p class="combo__stun">スタン : <span class="combo__text brand-text">{{combo.stun}}</span></p>
      <p class="combo__meter">ゲージ : <span class="combo__text brand-text">{{combo.meter}}</span></p>
      <p class="combo__recipe">レシピ : <span class="combo__text brand-text">{{combo.recipes[0].move.name}}&nbsp;…&nbsp;{{combo.recipes[combo.recipes.length - 1].move.name}}</span></p>
      <p class="combo__statuses">状態 : <span v-for="status in combo.statuses" class="combo__text brand-text">{{status.name}}</span></p>
    </router-link>
  </li>
</template>

<style scoped>
  li {
    list-style: none;
    border: 2px solid #D0D0D0;
    border-radius: 3px;
    background: #fff;
    margin-bottom: 15px;
  }
  p {
    margin: 0;
  }
  a {
    display: grid;
    grid-template-columns: 80px 1fr 1fr;
    grid-template-rows: repeat(4, minmax(30px, auto));
    padding: 10px;
  }
  .combo__statuses span + span:before
  {
    content: "、";
  }
  .combo__character {
    grid-row: 1 / 4;
    grid-column: 1 / 2;
    padding-right: 15px;
    text-align: center;
  }
  .combo__character__image {
    width: 100%;
  }
  .combo__damage {
    grid-row: 1 / 2;
    grid-column: 2 / 3;
  }
  .combo__stun {
    grid-row: 1 / 2;
    grid-column: 3 / 4;
  }
  .combo__meter {
    grid-row: 2 / 3;
    grid-column: 2 / 3;
  }
  .combo__recipe {
    grid-row: 3 / 4;
    grid-column: 2 / 4;
  }
  .combo__statuses {
    grid-row: 4 / 5;
    grid-column: 2 / 4;
  }
  .combo__text {
    font-weight: bold;
  }
</style>

<script>
  export default {
    props: {
      combo: {
        type: Object,
        required: true
      }
    }
  }
</script>