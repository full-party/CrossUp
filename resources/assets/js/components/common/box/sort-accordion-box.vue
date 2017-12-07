<template>
  <div class="accordion-wrapper">
    <p @click="show = !show">
      <span>並び順</span>
    </p>
    <transition name="slide-in">
      <div v-if="show">
        <div v-for="(sort, key) in sorts" class="sort">
          <label v-bind:for="key" v-on:change="close" class="sort__text">
            <input type="radio" v-bind:id="key" v-bind:value="key" v-model="selectSortId">
            {{sort.dispName}}
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
  .sort {
    display: inline-block;
    padding: 7px 5px;
  }
  .sort__text {
    background-color: #00AC0D;
    padding: 5px 11px;
  }
</style>

<script>
  export default {
    props: {
      sorts: {
        type: Object,
      },
    },
    data() {
      return {
        show: false,
        selectSortId: ''
      }
    },
    methods: {
      close() {
        this.show = false;
        this.$emit('input', this.selectSortId);
      }
    }
  }
</script>