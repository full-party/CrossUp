<template>
  <section>
    <h1>Combo Edit</h1>
    <p>{{ $route.params.id }}</p>
    <p>
      <p>Character : {{combo.character.name}}</p>
      <h3>Input Combo</h3>
      <span v-for="move in combo.combo">
        {{move.name}}
      </span>
      </div>
      <div class="moveList">
        <div v-for="move in moves" class="move" :move-id="move.id" @click="setMove(move)">
          {{move.name}}
        </div>
      </div>
      <button @click.prevent="allDelete">All Delete</button>
      <button @click.prevent="oneDelete">One Delete</button>
      <h3>Input Total Damage</h3>
      <input type="number" v-model="combo.damage" placeholder="Input Total Damage">
      <h3>Input Total Stun</h3>
      <input type="number" v-model="combo.stun" placeholder="Input Total Stun">
      <p>Meter : {{combo.meter}}</p>
      <h3>Input Memo</h3>
      <textarea v-model="combo.memo" placeholder="Input Memo"></textarea>
    </p>
    <p @click="updateCombo" v-if="combo.myComboFlg">update</p>
    <router-link :to="'/combos/' + $route.params.id">back combo detail</router-link>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }

  textarea {
    width: 100%;
  }

  .moveList {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    grid-column-gap: 10px;
    grid-row-gap: 10px;
  }

  .move {
    background-color: #00AC0D;
    text-align: center;
  }
</style>


<script>
  export default {
    created() {
        this.getCombo();
      },
    data() {
      return {
        moves: [],
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
          // 描画後に追加されるコンボ情報をVueで追跡させる
          this.$set(this.combo, 'combo', []);
          for(let recipe of this.combo.recipes) {
            this.combo.combo.push(recipe.move);
          }
          this.getMove();
        })
      },
      getMove() {
        axios.get('/api/moves', {
          params: {
            characterId: this.combo.character_id,
          }
        })
        .then(res =>  {
          this.moves = res.data;
        });
      },
      updateCombo() {
        console.log(this.combo);
        axios.put('/api/combos/' + this.combo.id, this.combo)
        .then(res => {
          console.log(res);
        });
      },
      setMove(move) {
        this.combo.combo.push(move);
      },
      allDelete() {
        this.combo.combo = [];
      },
      oneDelete() {
        this.combo.combo.pop();
      },
    }
  }
</script>