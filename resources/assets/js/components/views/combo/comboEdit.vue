<template>
  <section>
    <comboInput :Combo="Combo" :disabledSelectCharacter="true"></comboInput>
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
      }
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
        })
      },
      updateCombo() {
        console.log(this.Combo);
        axios.put('/api/combos/' + this.Combo.id, this.Combo)
        .then(res => {
          console.log(res);
        });
      },
    }
  }
</script>