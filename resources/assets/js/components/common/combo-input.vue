<template>
  <form id="form">
    <section class="combo__main-info">
      <div @click="charaModalOpen" class="combo__character">
        <img v-bind:src="selectCharacterImage" alt="character image" class="combo__character__image">
        <p class="combo__character__name">{{selectCharacterName}}</p>
      </div>
      <p class="combo__damage">
        ダメージ : <input type="number" v-model="inputCombo.damage" placeholder="Input Total Damage">
      </p>
      <p class="combo__stun">
        スタン : <input type="number" v-model="inputCombo.stun" placeholder="Input Total Stun">
      </p>
      <p class="combo__meter">
        メーター : <input type="number" v-model="inputCombo.meter" placeholder="Input Total Meter">
      </p>
    </section>
    <modal v-if="charaModal" @close="charaModalClose">
      <div slot="modal-contents">
        <p class="character__title">キャラクター選択</p>
        <div class="character__list">
          <div v-for="character in characters" class="character__list__item">
            <label v-bind:for="'character' + character.id" @click="charaModalClose">
              <img v-bind:src="'/img/character/' + character.image" alt="character image" class="character__image">
              <input class="character__radio-button" type="radio" v-bind:id="'character' + character.id" v-bind:value="character.id" v-model="inputCombo.character_id">
              {{character.name}}
            </label>
          </div>
        </div>
      </div>
    </modal>
    <section class="combo__statuses">
      <p>ステータス</p>
      <label v-for="status in statuses">
        <input type="checkbox" v-model="inputCombo.statuses" :value="status.id">
        {{status.name}}
      </label>
    </section>
    <section class="combo__recipes">
      <p>コンボ</p>
      <ol>
        <li v-for="move in inputCombo.combo">
          {{move.name}}
        </li>
      </ol>
    </section>
    <section class="combo__move__input">
      <div class="combo__move__input__header">
        <span class="combo__move__input__text">コンボ入力</span>
        <div class="combo__move__input__menu">
          <button @click.prevent="oneDelete" class="combo__move__input__one-delete">1つ削除</button>
          <button @click.prevent="allDelete" class="combo__move__input__all-delete">全て削除</button>
        </div>
      </div>
      <div class="moveList">
        <div v-for="move in moves" class="move" :move-id="move.id" @click="setMove(move)">
          <span class="move__text">{{move.name}}</span>
        </div>
      </div>
    </section>
    <section class="combo__memo">
      <p>メモ</p>
      <textarea v-model="inputCombo.memo" placeholder="Input Memo"></textarea>
    </section>
  </form>
</template>

<style scoped>
  p {
    margin: 0;
  }
  #form {
    padding-top: 20px;
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
  .combo__character__image {
    width: 100%;
  }
  .character__title {
    padding: 10px;
    font-size: 16px;
  }
  .character__list {
    display: grid;
    grid-auto-rows: minmax(100px, auto);
    grid-template-columns: repeat(auto-fit, 80px);
    justify-content: center;
  }
  .character__list__item {
    padding: 0 5px;
    text-align: center;
  }
  .character__image {
    width: 100%;
  }
  .character__radio-button {
    display: none;
  }
  ol {
    list-style: none;
    padding: 0;
  }
  li {
    display: inline-block;
  }
  li + li:before{
      content: " > ";
      padding: 0 10px;
  }
  .combo__move__input, .combo__recipes, .combo__memo, .combo__statuses {
    border: 1px solid #D0D0D0;
    background: #fff;
    padding: 10px;
    margin-bottom: 15px;
  }
  .combo__move__input__header {
    padding-bottom: 10px;
  }
  .combo__move__input__header:after {
    content:" ";
    display:block;
    clear:both;
  }
  .combo__move__input__text {
    float: left;
  }
  .combo__move__input__menu {
    display: inline-block;
    float: right;
  }
  .combo__move__input__one-delete, .combo__move__input__all-delete {
    background: #E6E6E6;
    border: none;
    height: 26px;
    padding: 0;
    width: 96px;
    margin: auto;
  }
  .move {
    display: inline-block;
    padding: 7px 5px;
  }
  .move__text {
    background-color: #00AC0D;
    padding: 5px 11px;
  }
  textarea {
    width: 100%;
    border: 1px solid black;
  }
</style>

<script>
  export default {
    components: {
      modal: require('./modal.vue'),
    },
    props: {
      defaultCombo: {
        type: Object,
      },
    },
    created() {
      this.getCharacters();
      this.getStatuses();

      if (this.defaultCombo) {
        this.setDefaultParameter(this.defaultCombo);
      }
    },
    watch: {
      // コンボに入力があった場合、emitする。
      inputCombo: {
        handler: function (inputCombo) {
          this.$emit('input', inputCombo);
        },
        deep: true
      },
      'inputCombo.character_id'(newVal, oldVal) {
        if (oldVal !== '' && newVal !== oldVal) {
          this.allDelete()
        }
      }
    },
    data() {
      return {
        inputCombo: {
          character_id: '',
          damage: '',
          stun: '',
          meter: 0,
          memo: '',
          statuses: [],
          recipes: [],
          combo: []
        },
        characters: [],
        charaModal: false,
        moves: [],
        statuses: [],
      }
    },
    computed: {
      selectCharacterName() {
        if (this.inputCombo.character_id === '') return;
        let name = '';
        this.getMove(this.inputCombo.character_id);
        for(let id in this.characters) {
          if(this.inputCombo.character_id === this.characters[id].id) {
            name = this.characters[id].name;
            break;
          }
        }
        return name;
      },
      selectCharacterImage() {
        let image = '/img/character.png';
        for(let id in this.characters) {
          if(this.inputCombo.character_id === this.characters[id].id) {
            image = '/img/character/' + this.characters[id].image;
            break;
          }
        }
        return image;
      }
    },
    methods: {
      // 初期値を格納
      setDefaultParameter(combo){
        this.inputCombo.character_id = combo.character_id;
        this.inputCombo.damage = combo.damage;
        this.inputCombo.stun = combo.stun;
        this.inputCombo.meter = combo.meter;
        this.inputCombo.memo = combo.memo;

        // TODO API修正後にrecipesへ移動
        this.inputCombo.combo = combo.combo;

        for (const status of combo.statuses) {
          this.inputCombo.statuses.push(status.id);
        }

      },
      getCharacters() {
        axios.get('/api/characters',{
          params: {
            gameId: this.$store.state.game.id,
          }
        })
        .then(res => {
          this.characters = res.data.data;
        });
      },
      getStatuses() {
        axios.get('/api/combos/statuses', {
          params: {
            gameId: this.$store.state.game.id,
          }
        })
          .then(res => {
            this.statuses = res.data;
          });
      },
      charaModalOpen() {
        if(this.defaultCombo) {return;}
        this.charaModal = true;
      },
      charaModalClose() {
        this.charaModal = false;
      },
      getMove(character_id) {
        axios.get('/api/moves', {
          params: {
            characterId: character_id,
          }
        })
        .then(res =>  {
          this.moves = res.data;
        });
      },
      setMove(move) {
        this.inputCombo.combo.push(move);
      },
      allDelete() {
        this.inputCombo.combo = [];
      },
      oneDelete() {
        this.inputCombo.combo.pop();
      },
    }
  }
</script>
