<template>
  <div>
    <div @click="showModal = true" class="fab">?</div>
    <transition name="modal">
      <section v-if="showModal" class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-contents">
              <h2>Search</h2>
              <p>Select Charactor</p>
              <p>Select First</p>
              <p>Select Sort Type</p>
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
        </div>
      </section>
    </transition>
  </div>
</template>

<style scoped>
  .fab {
    position: fixed;
    right: 16px;
    bottom: 16px;
    display: block;
    width: 56px;
    height: 56px;
    background: #03a9f4;
    text-align: center;
    border-radius: 50%;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.12), 0 2px 2px 0 rgba(0,0,0,.24);
    color: white;
    font-size: 24px;
  }

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

<script>
  export default {
    data() {
      return {
        showModal: false
      }
    }
  }
</script>