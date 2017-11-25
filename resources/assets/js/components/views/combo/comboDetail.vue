<template>
  <div>
    <section class="combo">
      <section class="combo__main-info">
        <div class="combo__character">
          <img v-bind:src="'/img/character/' + combo.character.image" alt="character image" class="combo__character__image">
          <p class="combo__character__name">{{combo.character.name}}</p>
        </div>
        <p class="combo__damage">ダメージ : {{combo.damage}}</p>
        <p class="combo__stun">スタン : {{combo.stun}}</p>
        <p class="combo__meter">ゲージ : {{combo.meter}}</p>
      </section>
      <section class="combo__statuses">
        <p>ステータス</p>
        <ol>
          <li v-for="status in combo.statuses">
            {{status.name}}
          </li>
        </ol>
      </section>
      <section class="combo__recipes">
        <p>コンボ</p>
        <ol>
          <li v-for="recipe in combo.recipes">
            {{recipe.move.name}}
          </li>
        </ol>
      </section>
      <section class="combo__memo">
        <p>メモ</p>
        <p>{{combo.memo}}</p>
      </section>
    </section>
    <section class="menu">
      <router-link class="back-link" to="/combos">
        <img src="/img/left-arrow.png" alt="left arrow">
        戻る
      </router-link>
      <router-link v-if="combo.myComboFlg" class="combo__edit-link" :to="'/combos/' + $route.params.id + '/edit'">
        <img src="/img/pen.png" alt="pen">
        編集
      </router-link>
      <div class="comob__delete-link" @click="delCombo" v-if="combo.myComboFlg">
        <img src="/img/garbage.png" alt="garbage">
        削除
      </div>
    </section>
  </div>
</template>

<style scoped>
  ol {
    list-style: none;
    padding: 0;
  }
  p {
    margin: 0;
  }
  li {
    display: inline-block;
  }
  .combo__recipes li + li:before {
    content: " > ";
    padding: 0 10px;
  }
  .combo__statuses li + li:before{
    content: "、";
  }
  .combo {
    padding: 20px 6px 0;
  }
  .combo__main-info {
    display: grid;
    grid-template-columns: 80px 1fr;
    grid-template-rows: repeat(3, 1fr);
    border: 1px solid #D0D0D0;
    background: #fff;
    padding: 10px;
    margin-bottom: 15px;
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
    grid-row: 2 / 3;
    grid-column: 2 / 3;
  }
  .combo__meter {
    grid-row: 3 / 4;
    grid-column: 2 / 3;
  }
  .combo__character__name {
    padding: 10px 0;
  }
  .combo__recipes, .combo__memo, .combo__statuses {
    border: 1px solid #D0D0D0;
    background: #fff;
    padding: 10px;
    margin-bottom: 15px;
  }
  .menu {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 1fr;
    background: #fff;
    text-align: center;
    line-height: 40px;
  }
  .back-link {
    grid-row: 1 / 2;
    grid-column: 1 / 2;
  }
  .combo__edit-link {
    grid-row: 1 / 2;
    grid-column: 2 / 3;
  }
  .combo__delete-link {
    grid-row: 1 / 2;
    grid-column: 3 / 4;
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
      delCombo() {
        console.log(this.combo.id);
        axios.delete('/api/combos/' + this.combo.id)
        .then(res => {
          console.log(res);
        });
      }
    }
  }
</script>