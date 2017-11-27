<template>
  <section>
    <h1>退会</h1>
    <div class="delete-id">
      <p>退会をするとデータが削除されますが、本当に退会しますか？</p>
      <div class="menu">
        <div class="menu__back">
          <router-link to="/setting" class="menu__back__button">キャンセル</router-link>
        </div>
        <div class="menu__update">
          <button @click="deleteId()" class="menu__deleteId__button">退会</button>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
  h1 {
    padding: 0 0 10px 10px;
  }
  .delete-id {
    background-color: #fff;
    padding: 10px;
  }
  .menu {
    display: grid;
    grid-template-columns: 40% 60%;
    grid-template-rows: 1fr;
    text-align: center;
    height: 40px;
    line-height: 40px;
  }
  .menu__back {
    grid-row: 1 / 2;
    grid-column: 1 / 2;
  }
  .menu__back__button {
    background: #E6E6E6;
    border: none;
    height: 40px;
    padding: 0;
    width: 100px;
    display: block;
    margin: auto;
  }
  .menu__update {
    grid-row: 1 / 2;
    grid-column: 2 / 3;
  }
  .menu__deleteId__button {
    background: #00CDFF;
    border: none;
    height: 40px;
    padding: 0;
    width: 150px;
  }
</style>

<script>
  export default {
    methods: {
      deleteId() {
        console.log('good by');
      }
    }
  }
</script>