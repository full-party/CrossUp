<template>
  <section>
    <h1>設定</h1>
    <div class="setting__menu">
      <router-link to="/setting/id" class="setting__menu__item">ID変更</router-link>
      <router-link to="/setting/address" class="setting__menu__item">メールアドレス変更</router-link>
      <router-link to="/setting/password" class="setting__menu__item">パスワード変更</router-link>
      <router-link to="/setting/delete/id" class="setting__menu__item">退会</router-link>
    </div>
    <section class="menu">
      <router-link class="back-link" to="/combos">
        <img src="/img/left-arrow.png" alt="left arrow">
        戻る
      </router-link>
    </section>
  </section>
</template>

<style scoped>
  h1 {
    padding: 0 0 10px 10px;
  }
  .setting__menu {
    background-color: #fff;
    padding-left: 30px;
    margin-bottom: 30px;
  }
  .setting__menu__item {
    border-bottom: 1px solid #DFDFDF;
    height: 40px;
    line-height: 40px;
    display: block;
    color: #4A4A4A;
  }
  .setting__menu__item:last-child {
    border-bottom: none;
  }
  .menu {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 1fr;
    background: #fff;
    text-align: center;
    line-height: 40px;
  }
  .back-link {
    grid-row: 1 / 2;
    grid-column: 1 / 2;
  }
</style>