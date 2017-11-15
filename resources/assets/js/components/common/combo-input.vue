<template>
  <form id="form">
    <section class="combo__main-info">
      <div @click="charaModalOpen" class="combo__character">
        <img src="/img/character.png" alt="character image">
        <p class="combo__character__name">{{selectCharacterName}}</p>
      </div>
      <p class="combo__damage">
        ダメージ : <input type="number" v-model="Combo.damage" placeholder="Input Total Damage">
      </p>
      <p class="combo__stun">
        スタン : <input type="number" v-model="Combo.stun" placeholder="Input Total Stun">
      </p>
      <p class="combo__meter">
        メーター : <input type="number" v-model="Combo.meter" placeholder="Input Total Meter">
      </p>
    </section>
    <modal v-if="charaModal" @close="charaModalClose">
      <div slot="modal-contents">
        <p>Now Select : {{selectCharacterName}}</p>
        <div v-for="character in characters">
          <label v-bind:for="'character' + character.id">
            <input type="radio" v-bind:id="'character' + character.id" v-bind:value="character.id" v-model="Combo.character_id">{{character.name}}
          </label>
        </div>
        <button @click.prevent="charaModalClose">OK</button>
      </div>
    </modal>
    <section class="combo__recipes">
      <p>コンボ</p>
      <ol>
        <li v-for="move in Combo.combo">
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
      <textarea v-model="Combo.memo" placeholder="Input Memo"></textarea>
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
  .combo__move__input, .combo__recipes, .combo__memo {
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
      Combo: {
        type: Object,
        required: true
      },
      // trueの場合キャラクター選択ができない
      disabledSelectCharacter: {
        type: Boolean,
      }
    },
    created() {
      this.getCharacters();
    },
    data() {
      return {
        characters: [],
        charaModal: false,
        moves: [],
      }
    },
    computed: {
      selectCharacterName() {
        if(!this.Combo.character_id) {return '';}
        let name = '';
        this.getMove(this.Combo.character_id);
        for(let id in this.characters) {
          if(this.Combo.character_id === this.characters[id].id) {
            name = this.characters[id].name;
            break;
          }
        }
        return name;
      }
    },
    methods: {
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
      charaModalOpen() {
        if(this.disabledSelectCharacter) {return;}
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
        this.Combo.combo.push(move);
      },
      allDelete() {
        this.Combo.combo = [];
      },
      oneDelete() {
        this.Combo.combo.pop();
      },
    }
  }
</script>
