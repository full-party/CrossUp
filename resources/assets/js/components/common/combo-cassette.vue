<template>
  <li>
    <router-link :to="'/combos/' + combo.id">
      <div class="combo__character">
        <img src="/img/character.png" alt="character image">
        <p class="combo__character__name">{{combo.character.name}}</p>
      </div>
      <p class="combo__damage">ダメージ : {{combo.damage}}</p>
      <p class="combo__stun">スタン : {{combo.stun}}</p>
      <p class="combo__meter">メーター : {{combo.meter}}</p>
      <p class="combo__first">始動技 : {{combo.recipes[0].move.name}}</p>
      <p class="combo__end">終了技 : {{combo.recipes[combo.recipes.length - 1].move.name}}</p>
      <p class="combo__memo">Memo : {{combo.memo}}</p>
    </router-link>
  </li>
</template>

<style scoped>
  li {
    list-style: none;
    border: 1px solid #D0D0D0;
    background: #fff;
    margin-bottom: 15px;
  }
  p {
    margin: 0;
  }
  a {
    display: grid;
    grid-template-columns: 80px 1fr 1fr;
    grid-template-rows: repeat(5, minmax(30px, auto));
    padding: 10px;
  }
  .combo__character {
    grid-row: 1 / 4;
    grid-column: 1 / 2;
    padding-right: 15px;
    text-align: center;
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
  .combo__first {
    grid-row: 3 / 4;
    grid-column: 2 / 4;
  }
  .combo__end {
    grid-row: 4 / 5;
    grid-column: 2 / 4;
  }
  .combo__memo {
    grid-row: 5 / 6;
    grid-column: 2 / 4;
  }
  .combo__character__name {
    padding: 10px 0;
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