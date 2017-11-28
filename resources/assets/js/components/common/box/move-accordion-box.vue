<template>
  <div class="accordion-wrapper">
    <p @click="show = !show">
      <span>始動技</span>
      <span v-if="selectCharacterName === ''"><br>キャラクターを選択してください</span>
    </p>
    <transition name="slide-in">
      <div v-if="show">
        <div v-for="move in moves" class="move">
          
          <label v-bind:for="'moveId_' + move.id" class="move__text" v-on:change="close">
            <input type="radio" v-bind:id="'moveId_' + move.id" v-bind:value="move.id" v-model="moveId">
            {{move.name}}
          </label>
        </div>
      </div>
    </transition>
  </div>
</template>

<style scoped>
  .accordion-wrapper {
    border: 1px solid #979797;
    background-color: #FAFAFA;
    margin-bottom: 3px;
    padding: 3px;
  }
  .slide-in-enter-active, .slide-in-leave-active {
    transition: all 0.7s ease;
  }
  .slide-in-enter, .slide-in-leave-to {
    opacity: 0;
  }
  input[type="radio"] {
    display: none;
  }
  .move {
    display: inline-block;
    padding: 7px 5px;
  }
  .move__text {
    background-color: #00AC0D;
    padding: 5px 11px;
  }
</style>


<script>
  export default {
    props: {
      moves: {
        type: Array,
      },
      selectCharacterName: {
        type: String,
      }
    },
    data() {
      return {
        show: false,
        moveId: ''
      }
    },
    methods: {
      close() {
        this.show = false;
        this.$emit('input', this.moveId);
      }
    }
  }
</script>