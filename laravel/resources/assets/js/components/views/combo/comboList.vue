<template>
  <section>
    <h1>Combo List</h1>
    <ul>
      <li v-for="combo in combos">
        <router-link :to="'/combos/' + combo.id">
          <p>Damege : {{combo.damage}}</p>
          <p>Stun : {{combo.stun}}</p>
          <p>Memo : {{combo.memo}}</p>
          <p>Character : {{combo.character_id}}</p>
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
              <p>Now Select : {{selectCharacter}}</p>
              <div v-for="character in characters">
                <input type="radio" v-bind:id="'character' + character.id" v-bind:value="character.name" v-model="selectCharacter">
                <label v-bind:for="'character' + character.id">{{character.name}}</label>
              </div>
            </div>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select First</span>
            <div slot="accordion-contents">
              <p>Now Select : {{selectFirst}}</p>
              <div v-for="first in firsts">
                <input type="radio" v-bind:id="'first' + first.id" v-bind:value="first.name" v-model="selectFirst">
                <label v-bind:for="'first' + first.id">{{first.name}}</label>
              </div>
            </div>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select Sort</span>
            <div slot="accordion-contents">
              <p>Now Select : {{selectSort}}</p>
              <div v-for="sort in sorts">
                <input type="radio" v-bind:id="'sort' + sort.id" v-bind:value="sort.name" v-model="selectSort">
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
        this.getFirsts();
        this.getSorts();
      },
    data() {
      return {
        combos: [],
        showModal: false,
        characters: [],
        selectCharacter: '',
        firsts: [],
        selectFirst: '',
        sorts: [],
        selectSort: ''
      }
    },
    methods: {
      getCombos() {
        axios.get('/api/combos')
        .then(res =>  {
          this.combos = res.data;
        })
      },
      getCharacters() {
        axios.get('/api/characters',{
          params: {
            gameId: localStorage.getItem('gameId')
          }
        })
        .then(res =>  {
          this.characters = res.data.data;
        })
      },
      getFirsts() {
       axios.get('/api/firstList')
        .then(res =>  {
          this.firsts = res.data;
        })
      },
      getSorts() {
       axios.get('/api/sortList')
        .then(res =>  {
          this.sorts = res.data;
        })
      }
    }
  }
</script>