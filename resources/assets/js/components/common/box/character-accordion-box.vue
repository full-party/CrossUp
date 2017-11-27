<template>
  <div class="accordion-wrapper">
    <p @click="show = !show">
      <span>キャラクター</span>
    </p>
    <transition name="slide-in">
      <div class="character__list" v-if="show">
        <div v-for="character in characters" class="character__list__item">
          <label v-bind:for="'character' + character.id" v-on:change="close">
            <img v-bind:src="'/img/character/' + character.image" alt="character image" class="character__image">
            <input class="character__radio-button" type="radio" v-bind:id="'character' + character.id" v-bind:value="character.id" v-model="characterId">
            {{character.name}}
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
    props: {
      characters: {
        type: Array,
      },
    },
    data() {
      return {
        show: false,
        characterId: ''
      }
    },
    methods: {
      close() {
        this.show = false;
        this.$emit('input', this.characterId);
      }
    }
  }
</script>