<template>
  <section>
    <h1>Combo List</h1>
    <h2>{{gameTitle}}</h2>
    <ul>
      <li v-for="combo in combos">
        <router-link :to="'/combos/' + combo.id">
          <p>Damege : {{combo.damage}}</p>
          <p>Stun : {{combo.stun}}</p>
          <p>Memo : {{combo.memo}}</p>
          <p>Character : {{combo.character.name}}</p>
        </router-link>
      </li>
    </ul>
    <fab @click="showModal = true"></fab>
    <modal v-if="showModal">
      <div slot="modal-contents">
        <h2>Search</h2>
          <accordionBox>
            <span slot="accordion-title">Select Charactor</span>
            <div slot="accordion-contents">
              <p>Now Select : {{search.selectCharacter}}</p>
              <div v-for="character in characters">
                <input type="radio" v-bind:id="'character' + character.id" v-bind:value="character.name" v-model="search.selectCharacter">
                <label v-bind:for="'character' + character.id">{{character.name}}</label>
              </div>
            </div>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select Move</span>
            <div slot="accordion-contents">
              <p>Now Select : {{search.selectMove}}</p>
              <div v-for="move in search.moves">
                <input type="radio" v-bind:id="'moveId_' + move.id" v-bind:value="move.name" v-model="search.selectMove">
                <label v-bind:for="'moveId_' + move.id">{{move.name}}</label>
              </div>
            </div>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select Sort</span>
            <div slot="accordion-contents">
              <p>Now Select : {{search.selectSort}}</p>
              <div v-for="sort in search.sorts">
                <input type="radio" v-bind:id="'sort' + sort.id" v-bind:value="sort.name" v-model="search.selectSort">
                <label v-bind:for="'sort' + sort.id">{{sort.name}}</label>
              </div>
            </div>
          </accordionBox>
          <p>
            <div @click="showModal = false">
              chancel
            </div>
          </p>
          <p>
            <div @click="showModal = false">
              ok
            </div>
          </p>
        </div>
    </modal>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
  }
</style>

<script>
  export default {
    components: {
      fab: require('../../common/button/floating-action-button.vue'),
      modal: require('../../common/modal.vue'),
      accordionBox: require('../../common/box/accordion-box.vue'),
    },
    created() {
        this.getCombos();
        this.getCharacters();
        this.getSorts();
        this.getGame();
      },
    data() {
      return {
        combos: [],
        showModal: false,
        characters: [],
        search: {
          selectCharacter: '',
          selectCharacterId: '',
          moves: [],
          selectMove: '',
          sorts: [],
          selectSort: '',
        },
        gameId: localStorage.getItem('gameId'),
        gameTitle: ''
      }
    },
    watch: {
      'search.selectCharacter': {
        handler: function () {
          for(let id in this.characters) {
            if(this.search.selectCharacter === this.characters[id].name) {
              this.search.selectCharacterId = this.characters[id].id;
              break;
            }
          }
          axios.get('/api/moves', {
            params: {
              characterId: this.search.selectCharacterId,
            }
          })
          .then(res =>  {
            this.search.selectMove = '';
            this.search.moves = res.data;
          });
        },
        deep: true
      },
    },
    methods: {
      getGame() {
        axios.get('/api/games/' + this.gameId)
        .then(res =>  {
          this.gameTitle = res.data.name;
        })
      },
      getCombos() {
        axios.get('/api/combos')
        .then(res =>  {
          this.combos = res.data;
        })
      },
      getCharacters() {
        axios.get('/api/characters',{
          params: {
            gameId: this.gameId
          }
        })
        .then(res =>  {
          this.characters = res.data.data;
        })
      },
      getSorts() {
       axios.get('/api/sortList')
        .then(res =>  {
          this.search.sorts = res.data;
        })
      }
    }
  }
</script>