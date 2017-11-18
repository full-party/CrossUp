<template>
  <section class="combo-list">
    <h1>Combo List</h1>
    <ul>
      <comboCassette v-for="combo in combos" :key="combo.id" :combo="combo"></comboCassette>
    </ul>
    <fab @click="showModal = true"></fab>
    <modal v-if="showModal">
      <div slot="modal-contents" class="modal__contents">
        <h2>検索</h2>
        <p>キャラクター：{{selectCharacterName}} <span v-if="search.characterId !== ''" @click="search.characterId = ''">×</span></p>
          <accordionBox ref="character" class="character__select">
            <span slot="accordion-title">キャラクター</span>
            <div slot="accordion-contents">
              <div class="character__list">
                <div v-for="character in characters" class="character__list__item">
                  <label v-bind:for="'character' + character.id" @click="characterClose">
                    <img v-bind:src="'/img/character/' + character.image" alt="character image" class="character__image">
                    <input class="character__radio-button" type="radio" v-bind:id="'character' + character.id" v-bind:value="character.id" v-model="search.characterId">
                    {{character.name}}
                  </label>
                </div>
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
  .modal__contents {
    padding: 0 10px;
  }
  .character__list {
    display: grid;
    grid-auto-rows: minmax(100px, auto);
    grid-template-columns: repeat(auto-fit, 74px);
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
    computed: {
      selectCharacterName() {
        if(!this.search.characterId) {return '';}
        let name = '';
        this.getMove(this.search.characterId);
        for(let id in this.characters) {
          if(this.search.characterId === this.characters[id].id) {
            name = this.characters[id].name;
            break;
          }
        }
        return name;
      },
    },
    watch: {
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
      },
      characterClose() {
        this.$refs.character.close();
      }
    }
  }
</script>