<template>
  <section>
    <h1>Combo List</h1>
    <router-link to="/games">Select to games</router-link>
    <ul>
      <li v-for="combo in combos">
        <p>{{combo.damage}}</p>
        <router-link :to="'/combos/' + combo.id">{{combo.title}}</router-link>
      </li>
    </ul>
    <fab @click="showModal = true"></fab>
    <modal v-if="showModal">
      <div slot="modal-contents">
        <h2>Search</h2>
          <accordionBox>
            <span slot="accordion-title">Select Charactor</span>
            <p slot="accordion-contents">
              <ul>
                <li>hoge</li>
                <li>hoge1</li>
                <li>hoge2</li>
              </ul>
            </p>
          </accordionBox>
          <accordionBox>
            <span slot="accordion-title">Select First</span>
            <p slot="accordion-contents">
              <ul>
                <li>fuga</li>
                <li>fuga1</li>
                <li>fuga2</li>
              </ul>
            </p>
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
      fab: require('../common/button/floating-action-button.vue'),
      modal: require('../common/modal.vue'),
      accordionBox: require('../common/box/accordion-box.vue'),
    },
    created() {
        this.getCombos()
      },
    data() {
      return {
          combos: [],
          showModal: false,
      }
    },
    methods: {
      getCombos() {
        axios.get('/api/comboList')
        .then(res =>  {
          this.combos = res.data
        })
      }
    }
  }
</script>