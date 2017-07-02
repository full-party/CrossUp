<template>
  <section>
    <h1>Combo Create</h1>
    <h2>Game is {{gameTitle}}</h2>
    <form id="form">
      <h3 @click="charaModal = true">Choose Character</h3>
      <p>Now Select : {{Combo.selectCharacterName}}</p>
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
      <h3>Input Combo</h3>
      <span v-for="move in Combo.combo">
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
      <input type="number" v-model="Combo.damage" placeholder="Input Total Damage">
      <h3>Input Total Stun</h3>
      <input type="number" v-model="Combo.stun" placeholder="Input Total Stun">
      <h3>Input Total Meter</h3>
      <input type="number" v-model="Combo.meter" placeholder="Input Total Meter">
      <h3>Input Memo</h3>
      <textarea v-model="Combo.memo" placeholder="Input Memo"></textarea>
      <input type="submit" value="Create" v-on:click.prevent="create">
    </form>
    <modal v-if="createModal" @close="createModal = false">
      <div slot="modal-contents">
        <h3>Create!</h3>
        <p>Game : {{gameTitle}} / {{gameId}}</p>
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
    <router-link to="/combos">back combo list</router-link>
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
    components: {
      modal: require('../../common/modal.vue'),
    },
    created() {
      this.getCharacters();
      this.getGame();
    },
    data() {
      return {
        gameId: localStorage.getItem('gameId'),
        gameTitle: '',
        characters: [],
        moves: [],
        charaModal: false,
        createModal: false,
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
      getGame() {
        axios.get('/api/games/' + this.gameId)
        .then(res =>  {
          this.gameTitle = res.data.name;
        });
      },
      getCharacters() {
        axios.get('/api/characters',{
          params: {
            gameId: this.gameId,
          }
        })
        .then(res => {
          this.characters = res.data.data;
        });
      },
      create() {
        this.createModal = true;
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