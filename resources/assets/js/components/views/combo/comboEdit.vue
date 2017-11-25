<template>
  <section>
    <comboInput v-if="showComponent" v-model="inputCombo" :default-combo="Combo"></comboInput>
    <p @click="updateCombo" v-if="Combo.myComboFlg">update</p>
    <router-link :to="'/combos/' + $route.params.id">back combo detail</router-link>
  </section>
</template>

<style scoped>
</style>


<script>
  export default {
    components: {
      comboInput: require('../../common/combo-input.vue'),
    },
    created() {
        this.getCombo();
      },
    data() {
      return {
        Combo: {},
        inputCombo: {},
        showComponent: false,
      };
    },
    methods: {
      getCombo() {
        axios.get('/api/combos/' + this.$route.params.id)
        .then(res =>  {
          this.Combo = res.data;
          // 描画後に追加されるコンボ情報をVueで追跡させる
          this.$set(this.Combo, 'combo', []);
          for(let recipe of this.Combo.recipes) {
            this.Combo.combo.push(recipe.move);
          }
          this.showComponent = true;
        })
      },
      updateCombo() {
        axios.put('/api/combos/' + this.Combo.id, this.inputCombo)
        .then(res => {
          console.log(res);
        });
      },
    }
  }
</script>