<template>
  <section class="combo__create">
    <comboInput v-if="reset" v-model="inputCombo"></comboInput>
    <modal v-if="createModal" @close="createModal = false">
      <div slot="modal-contents">
        <h3>Create!</h3>
        <p>Character : {{inputCombo.selectCharacterName}} / {{inputCombo.selectCharacterId}}</p>
        <p>Combo</p>
        <span v-for="move in inputCombo.combo">
          {{move.name}}
        </span>
        <p>Damage : {{inputCombo.damage}}</p>
        <p>Stun : {{inputCombo.stun}}</p>
        <p>Mete : {{inputCombo.meter}}</p>
        <p>Memo : {{inputCombo.memo}}</p>
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
  p {
    margin: 0;
  }
  .combo__create {
    padding-bottom: 20px;
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
      comboInput: require('../../common/combo-input.vue'),
    },
    data() {
      return {
        createModal: false,
        errorModal: false,
        inputCombo: {},
        defaultCombo: {},
        reset: true,
      };
    },
    methods: {
      create() {
        axios.post('/api/combos',this.inputCombo)
        .then(res => {
          this.createModal = true;
        })
        .catch(err => {
          this.errorModal = true;
        });
      },
      init() {
        this.createModal = false;

        // TODO 他にいい方法を探す。。
        this.reset = false;
        this.$nextTick(function () {
          this.reset = true;
        });
      },
    },
  };
</script>