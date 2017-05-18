<template>
  <div class="slidebarWrap">
    <div @click="show = true">
      三
    </div>
    <transition name="fade">
      <section v-if="show" @click="show = false"></section>
    </transition>
    <transition name="slide">
      <nav v-if="show">
        <ul>
          <li @click="show = false"><router-link to="/combos/create">create combo</router-link></li>
          <li @click="show = false"><router-link to="/games">Select to games</router-link></li>
          <li @click="show = false"><router-link to="/setting">setting</router-link></li>
          <li>logout</li>
        </ul>
      </nav>
    </transition>
  </div>
</template>

<style scoped>
  .slidebarWrap {
    display: inline-block;
    width: 30px;
    height: 100%;
    float: right;
  }
  section {
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: black;
    opacity: 0.7;
    z-index: 10;
  }
  nav {
    width: 60vw;
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
    background: gainsboro;
    z-index: 20;
  }

  .fade-enter-active, .fade-leave-active {
    transition: all 0.7s ease;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }

  .slide-enter-active, .slide-leave-active {
    transition: all 0.7s ease;
  }
  .slide-enter, .slide-leave-to {
    transform: translateX(100%);
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