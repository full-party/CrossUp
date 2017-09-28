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
          <p>Meter : {{combo.meter}}</p>
          <p>First Move : {{combo.recipes[0].move.name}}</p>
          <p>End Move : {{combo.recipes[combo.recipes.length - 1].move.name}}</p>
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
              <p>Now Select : {{selectMove}}</p>
              <div v-for="move in moves">
                <input type="radio" v-bind:id="'moveId_' + move.id" v-bind:value="move.name" v-model="selectMove">
                <label v-bind:for="'moveId_' + move.id">{{move.name}}</label>
              </div>
            </div>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select Sort</span>
            <div slot="accordion-contents">
              <p>Now Select : {{search.selectSort}}</p>
              <div v-for="(sort, key) in sorts">
                <input type="radio" v-bind:id="key" v-bind:value="sort.dispName" v-model="selectSort">
                <label v-bind:for="key">{{sort.dispName}}</label>
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
        sorts: [],
        moves: [],
        selectCharacter: '',
        selectSort: '',
        selectMove: '',
        search: {
          filter: {
            character_id: 1,
          },
          selectSortId: '',
        },
        gameId: localStorage.getItem('gameId'),
        gameTitle: ''
      }
    },
    watch: {
      'selectCharacter': {
        handler: function () {
          for(let id in this.characters) {
            if(this.selectCharacter === this.characters[id].name) {
              this.search.filter.character_id = this.characters[id].id;
              break;
            }
          }
          axios.get('/api/moves', {
            params: {
              characterId: this.search.filter.character_id,
            }
          })
          .then(res =>  {
            this.selectMove = '';
            this.moves = res.data;
          });
        },
        deep: true
      },
      'selectSort': {
        handler: function() {
          for(let id in this.sorts) {
            if(this.selectSort === this.sorts[id].dispName) {
              this.search.selectSortId = id;
            }
          }
          console.log(this.search.selectSortId);
        },
        deep: true
      }
    },
    methods: {
      getGame() {
        axios.get('/api/games/' + this.gameId)
        .then(res =>  {
          this.gameTitle = res.data.name;
        })
      },
      getCombos() {
        axios.get('/api/combos',{
          params: this.search
        })
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
          this.sorts = res.data[0];
        })
      }
    }
  }
</script>