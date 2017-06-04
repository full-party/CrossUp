<template>
  <transition name="modal">
    <section class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-contents">
           <slot name="modal-contents"></slot>
        </div>
      </div>
    </section>
  </transition>
</template>

<style scoped>
  .modal-mask {
    width: 100vw;
    height: 100vh;
    position: fixed;
    display: table;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, .5);
    z-index: 10;
  }
  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }
  .modal-contents {
    width: 80vw;
    height: 80vh;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    overflow: scroll;
  }

  .modal-enter-active, .modal-leave-active {
    transition: all 0.5s ease;
  }
  .modal-enter, .modal-leave-to {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
    opacity: 0;
  }
</style>