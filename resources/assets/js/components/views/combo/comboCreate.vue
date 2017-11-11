<template>
  <section class="combo__create">
    <form id="form">
      <section class="combo__main-info">
        <div @click="charaModal = true" class="combo__character">
          <img src="/img/character.png" alt="character image">
          <p class="combo__character__name">{{Combo.selectCharacterName}}</p>
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
          <p>Now Select : {{Combo.selectCharacterName}}</p>
          <div v-for="character in characters">
            <label v-bind:for="'character' + character.id">
              <input type="radio" v-bind:id="'character' + character.id" v-bind:value="character.name" v-model="Combo.selectCharacterName">{{character.name}}
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
    <modal v-if="createModal" @close="createModal = false">
      <div slot="modal-contents">
        <h3>Create!</h3>
        <p>Character : {{Combo.selectCharacterName}} / {{Combo.selectCharacterId}}</p>
        <p>Combo</p>
        <span v-for="move in Combo.combo">
          {{move.name}}
        </span>
        <p>Damage : {{Combo.damage}}</p>
        <p>Stun : {{Combo.stun}}</p>
        <p>Mete : {{Combo.meter}}</p>
        <p>Memo : {{Combo.memo}}</p>
        <router-link to="/combos">back combo list</router-link>
        <p @click="init">create combo</p>
      </div>
    </modal>
    <modal v-if="errorModal" @close="errorModal = false">
      <div slot="modal-contents">
        <h3>Error</h3>
      </div>
    </modal>
    <section class="menu">
      <div class="menu__back">
        <router-link to="/combos" class="menu__back__button">キャンセル</router-link>
      </div>
      <div class="menu__create">
        <input type="submit" value="Create" v-on:click.prevent="create" class="menu__create__button">
      </div>
    </section>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
  textarea {
    width: 100%;
    border: 1px solid black;
  }
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
  li + li:before{
      content: " > ";
      padding: 0 10px;
  }
  .combo__create {
    padding-bottom: 20px;
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
  .menu {
    display: grid;
    grid-template-columns: 40% 60%;
    grid-template-rows: 1fr;
    text-align: center;
    height: 40px;
    line-height: 40px;
  }
  .menu__back {
    grid-row: 1 / 2;
    grid-column: 1 / 2;
  }
  .menu__back__button {
    background: #E6E6E6;
    border: none;
    height: 40px;
    padding: 0;
    width: 100px;
    display: block;
    margin: auto;
  }
  .menu__create {
    grid-row: 1 / 2;
    grid-column: 2 / 3;
  }
  .menu__create__button {
    background: #00CDFF;
    border: none;
    height: 40px;
    padding: 0;
    width: 150px;
  }
</style>

<script>
  export default {
    components: {
      modal: require('../../common/modal.vue'),
    },
    created() {
      this.getCharacters();
    },
    data() {
      return {
        characters: [],
        moves: [],
        charaModal: false,
        createModal: false,
        errorModal: false,
        Combo: {
          selectCharacterName: '',
          selectCharacterId: '',
          combo: [],
          damage: '',
          stun: '',
          meter: '',
          memo: '',
        },
      };
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
      create() {
        axios.post('/api/combos',this.Combo)
        .then(res => {
          this.createModal = true;
        })
        .catch(err => {
          this.errorModal = true;
        });
      },
      init() {
        this.createModal = false;
        for(let id in this.Combo) {
          if(Array.isArray(this.Combo[id])) {
            this.Combo[id] = [];
          } else {
            this.Combo[id] = '';
          }
        }
      },
      charaModalClose() {
        this.charaModal = false;
        this.setCharacter();
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
      setCharacter() {
        for(let id in this.characters) {
          if(this.Combo.selectCharacterName === this.characters[id].name) {
            this.Combo.selectCharacterId = this.characters[id].id;
            break;
          }
        }
        axios.get('/api/moves', {
          params: {
            characterId: this.Combo.selectCharacterId,
          }
        })
        .then(res =>  {
          this.moves = res.data;
        });
      }
    },
  };
</script>