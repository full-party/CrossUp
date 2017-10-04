<template>
  <div class="accordion-wrapper">
    <p @click="show = !show">
      <slot name="accordion-title"></slot>
    </p>
    <transition name="slide-in">
      <div v-if="show">
        <slot name="accordion-contents"></slot>
      </div>
    </transition>
  </div>
</template>

<style scoped>
  .accordion-wrapper {
    border: 1px solid #000;
    margin-bottom: 3px;
    padding: 3px;
  }
  .slide-in-enter-active, .slide-in-leave-active {
    transition: all 0.7s ease;
  }
  .slide-in-enter, .slide-in-leave-to {
    opacity: 0;
  }
</style>

<script>
  export default {
    data() {
      return {
        show: false
      }
    }
  }
</script>