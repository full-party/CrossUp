<template>
  <section class="combo-list">
    <h1>Combo List</h1>
    <ul>
      <comboCassette v-for="combo in combos" :key="combo.id" :combo="combo"></comboCassette>
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
              <p>Now Select : {{selectSort}}</p>
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
            <div @click="searchCombo">
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
  ul {
    margin: 0;
    padding: 0;
  }
  .combo-list {
    padding: 0 6px;
  }
</style>

<script>
  export default {
    components: {
      fab: require('../../common/button/floating-action-button.vue'),
      modal: require('../../common/modal.vue'),
      accordionBox: require('../../common/box/accordion-box.vue'),
      comboCassette: require('../../common/combo-cassette.vue'),
    },
    created() {
        this.getCombos();
        this.getCharacters();
        this.getSorts();
      },
    data() {
      return {
        // コンボのリスト
        combos: [],
        // 検索モーダル表示フラグ
        showModal: false,
        // キャラクターリスト
        characters: [],
        // コンボのソートリスト
        sorts: [],
        // キャラクターの技リスト
        moves: [],
        // 選択されているキャラクター
        selectCharacter: '',
        // 選択されているソート名（初期ソート値を指定）
        selectSort: 'ダメージ値降順',
        // 選択されている始動技
        selectMove: '',
        // 検索用パラメーター
        search: {
          selectSortId: 'DAMAGE_DESC',
          characterId: '',
          moveId: '',
        },
      }
    },
    watch: {
      // キャラクターが選択されたらキャラクターを検索パラメーターに追加する
      // 追加後キャラクターの技をAPIを叩き取得する
      'selectCharacter': {
        handler: function() {
          for(let id in this.characters) {
            if(this.selectCharacter === this.characters[id].name) {
              this.search.characterId = this.characters[id].id;
              break;
            }
          }
          axios.get('/api/moves', {
            params: {
              characterId: this.search.characterId,
            }
          })
          .then(res =>  {
            this.selectMove = '';
            this.search.moveId = '';
            this.moves = res.data;
          });
        }
      },
      // 始動技が選択されたら技IDを検索パラメーターに追加する
      'selectMove': {
        handler: function() {
          for(let id in this.moves) {
            if(this.selectMove === this.moves[id].name) {
              this.search.moveId = this.moves[id].id;
              break;
            }
          }
        }
      },
      // ソートが選択されたらソートIDを検索パラメーターに追加する
      'selectSort': {
        handler: function() {
          for(let id in this.sorts) {
            if(this.selectSort === this.sorts[id].dispName) {
              this.search.selectSortId = id;
            }
          }
        }
      }
    },
    methods: {
      // コンボ取得関数
      getCombos() {
        axios.get('/api/combos',{
          params: this.search
        })
        .then(res =>  {
          this.combos = res.data;
        })
      },
      // キャラクター取得関数
      getCharacters() {
        axios.get('/api/characters',{
          params: {
            gameId: this.$store.state.game.id,
          }
        })
        .then(res =>  {
          this.characters = res.data.data;
        })
      },
      // ソート取得関数
      getSorts() {
        axios.get('/api/sortList')
        .then(res =>  {
          this.sorts = res.data[0];
        })
      },
      // コンボを検索して検索モーダルを非表示にする
      searchCombo() {
        this.getCombos();
        this.showModal = false;
      }
    }
  }
</script>