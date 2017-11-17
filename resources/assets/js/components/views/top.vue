<template>
  <section class="top">
    <section class="hero-header">
      <div class="hero-header__layer">
        <h1 class="hero-header__title">Cross Up</h1>
        <p class="hero-header__text">
          全ての格ゲーマーのためのメモサイト
        </p>
      </div>
    </section>
    <section class="form">
      <userInput></userInput>
    </section>
    <section class="about">
      <h2>About</h2>
      <p class="about__text">
        シンプルで使いやすい格ゲー専用のコンボメモサイトです。<br>
        思いついた時にすぐメモを取ることができ、キャラクターと始動技で絞り込む事により<br>
        最適なコンボを探すことができます。
      </p>
    </section>
    <section class="screen-shorts">
      <h2>Screen Shorts</h2>
      <img src="/img/screenshorts/1.png" alt="screen shorts" class="screen-shorts__img">
    </section>
    <section class="contact">
      <h2>Contact</h2>
      <img src="/img/mail.png" alt="mail">
      <p class="contact__text">hoge@gmail.com</p>
    </section>
  </section>
</template>

<style scoped>
  h1, h2 {
    margin: 0;
    padding: 20px 0;
  }
  p {
    margin: 0;
  }
  .top {
    text-align: center;
  }
  .hero-header {
    height: 100vh;
    background-image: url(/img/top/sp-top.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    color: #fff;
  }
  .hero-header__layer {
    height: 100vh;
    background-color: rgba(74,74,74,0.7);
    padding-top: 30vh;
  }
  .hero-header__title {
    font-size: 44px;
  }
  .form {
    background-color: #fff;
    padding: 20px 10px;
  }
  .about {
    background-color: #ececec;
    height: 400px;
  }
  .about__text {
    padding: 0 10px;
    line-height: 2;
  }
  .screen-shorts {
    background-color: #fff;
    padding-bottom: 20px;
  }
  .screen-shorts__img {
    width: 80%;
    border-radius: 20px;
    padding: 10px;
    display: inline;
    border: 2px solid #e5e5e5;
  }
  .contact {
    background-color: #ececec;
    height: 400px;
  }
  .contact__text {
    padding-top: 10px;
  }
</style>

<script>
  export default {
    components: {
      userInput: require('../common/user-input.vue'),
    },
  }
</script>