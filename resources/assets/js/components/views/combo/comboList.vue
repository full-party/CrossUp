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
        <p>始動技：{{selectMove}} <span v-if="search.moveId !== ''" @click="search.moveId = ''">×</span></p>
        <characterAccordionBox v-model="search.characterId" :characters="characters"></characterAccordionBox>
        <moveAccordionBox v-model="search.moveId" :moves="moves" :selectCharacterName="selectCharacterName"></moveAccordionBox>
          <accordionBox>
            <span slot="accordion-title">Select Status</span>
            <div slot="accordion-contents">
              <p>Now Select : <span class="status-name" v-for="statusName in selectStatus">{{statusName}}</span></p>
              <div v-for="(status, key) in statuses">
                <input type="checkbox" v-bind:id="key" v-bind:value="status.id" v-model="search.status">
                <label v-bind:for="key">{{status.name}}</label>
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
  .status-name + .status-name:before {
    content: "、";
  }
  .modal__contents {
    padding: 0 10px;
  }
</style>

<script>
  export default {
    components: {
      fab: require('../../common/button/floating-action-button.vue'),
      modal: require('../../common/modal.vue'),
      accordionBox: require('../../common/box/accordion-box.vue'),
      characterAccordionBox: require('../../common/box/character-accordion-box.vue'),
      moveAccordionBox: require('../../common/box/move-accordion-box.vue'),
      comboCassette: require('../../common/combo-cassette.vue'),
    },
    created() {
        this.getCombos();
        this.getCharacters();
        this.getSorts();
        this.getStatuses();
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
        // ステータスリスト
        statuses: [],
        // 選択されているソート名（初期ソート値を指定）
        selectSort: 'ダメージ値降順',
        // 検索用パラメーター
        search: {
          selectSortId: 'DAMAGE_DESC',
          characterId: '',
          moveId: '',
          status: [],
        },
      }
    },
    computed: {
      selectCharacterName() {
        if(!this.search.characterId) {return '';}
        let name = '';
        for(let id in this.characters) {
          if(this.search.characterId === this.characters[id].id) {
            name = this.characters[id].name;
            break;
          }
        }
        return name;
      },
      selectStatus(){
        const names = [];
        for (const status of this.statuses) {
          if (this.search.status.indexOf(status.id) >= 0) {
            names.push(status.name);
          }
        }
        return names;
      },
      selectMove() {
        if(!this.search.moveId) {return '';}
        let name = '';
        for (let id in this.moves) {
          if (this.search.moveId === this.moves[id].id) {
            name = this.moves[id].name;
          }
        }
        return name;
      }
    },
    watch: {
      // キャラクターが変更されたらコンボを取得し、選択している始動技をクリアする
      'selectCharacterName': {
        handler: function() {
          if(this.search.characterId) {
            this.getMove(this.search.characterId);
          } else {
            this.moves = [];
          }
          this.search.moveId = '';
        },
        deep: true
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
      getStatuses(){
        axios.get('/api/combos/statuses',{
          params: {
            gameId: this.$store.state.game.id,
          }
        })
          .then(res =>  {
            this.statuses = res.data;
          })
      },
      // コンボを検索して検索モーダルを非表示にする
      searchCombo() {
        this.getCombos();
        this.showModal = false;
      }
    },
  }
</script>