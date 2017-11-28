<template>
  <section>
    <h1>パスワード変更</h1>
    <section class="password__edit">
      <p class="password_edit__title">
        Password
        <span v-show="passwordValidation.password">OK!</span>
      </p>
      <input type="password" v-model="password" placeholder="Pass Word">
      <p class="password_edit__title">
        Re Password
        <span v-show="passwordValidation.rePassword && passwordValidation.equalPassword">OK!</span>
      </p>
      <input type="password" v-model="rePassword" placeholder="Re Pass Word">
      <div class="menu">
        <div class="menu__back">
          <router-link to="/setting" class="menu__back__button">キャンセル</router-link>
        </div>
        <div class="menu__update">
          <button v-bind:disabled="!passwordValidation.password || !passwordValidation.equalPassword" @click="change()" class="menu__update__button">変更</button>
        </div>
      </div>
    </section>
  </section>
</template>

<style scoped>
  h1, .error {
    padding: 0 0 10px 10px;
  }
  .password__edit {
    background-color: #fff;
    padding: 10px;
  }
  input[type="password"] {
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
  export default {
    data() {
      return {
        password: '',
        rePassword: '',
      };
    },
    computed: {
      passwordValidation() {
        return {
          password: !!this.password.trim(),
          rePassword: !!this.rePassword.trim(),
          equalPassword: this.password === this.rePassword,
        };
      },
    },
    methods: {
      isValid(validation) {
        return Object.keys(validation).every(key => {
          return validation[key];
        });
      },
      change() {
        if (this.isValid(this.passwordValidation)) {
          axios.put('/api/users/' + localStorage.getItem('id') , {password: this.password})
            .then(res => {
              console.log('ok')
            })
            .catch(err => {
              console.log('error');
            });
        } else {
          console.log('error');
        }
      },
    },
  }
</script>