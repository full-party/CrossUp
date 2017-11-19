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
    <section class="screen-shots">
      <h2>Screen shot</h2>
      <img src="/img/screenshots/1.png" alt="screen shots" class="screen-shots__img">
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
  .screen-shots {
    background-color: #fff;
    padding-bottom: 20px;
  }
  .screen-shots__img {
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
    methods: {
      isValid(validation) {
        return Object.keys(validation).every(key=> {
          return validation[key];
        })
      },
      login() {
        if(this.isValid(this.loginValidation)) {
          axios.post('/api/login',{
            loginId: this.User.id,
            password: this.User.password
          })
          .then(res =>  {
            // ログイン成功、ローカルストレージにユーザー情報を格納する
            localStorage.setItem('id', res.data.id);
            this.$router.push('games');
          })
          .catch(error => {
            // ログイン失敗
            this.errorMessage = error.response.data.message;
            this.showError = true;
          });
        } else {
          this.showError = true;
        }
      },
      addUser() {
        if(this.isValid(this.userValidation)) {
          axios.post('/api/users',{
            login_id: this.User.id,
            password: this.User.password,
            email: this.User.email
          })
          .then(res =>  {
            // 登録成功
            this.showAddUserSuccess = true;
          })
          .catch(error => {
            // 登録失敗
          });
        } else {
        }
      }
    }
  }
</script>