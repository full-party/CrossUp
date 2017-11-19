<template>
  <section>
    <h1>メールアドレス変更</h1>
    <section class="address__edit">
      <p class="address_edit__title">
        Mail Address
        <span v-show="emailValidation.validationRe">OK!</span>
      </p>
      <input type="email" v-model="email" placeholder="Email">
      <div class="menu">
        <div class="menu__back">
          <router-link to="/setting" class="menu__back__button">キャンセル</router-link>
        </div>
        <div class="menu__update">
          <button v-bind:disabled="!emailValidation.validationRe" @click="change()" class="menu__update__button">変更</button>
        </div>
      </div>
    </section>
  </section>
</template>

<style scoped>
  h1 {
    padding: 0 0 10px 10px;
  }
  .address__edit {
    background-color: #fff;
    padding: 10px;
  }
  input[type="email"] {
    border: 1px solid #e5e5e5;
    width: 100%;
    height: 40px;
    margin-bottom: 20px;
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
  .menu__update__button {
    background: #00CDFF;
    border: none;
    height: 40px;
    padding: 0;
    width: 150px;
  }
</style>

<script>
  const emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  export default {
    data() {
      return {
        email: '',
      };
    },
    computed: {
      emailValidation() {
        return {
          validationRe: emailRE.test(this.email),
        };
      },
    },
    methods: {
      change() {
        if (this.emailValidation.validationRe) {
          axios.put('/api/users/' + localStorage.getItem('id') , {email: this.email})
            .then(res => {
              console.log('ok');
            })
            .catch(err => {
              console.log('error');
            });
        } else {
          console.log('false');
        }
      },
    },
  }
</script>