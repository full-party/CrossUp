<template>
  <div class="user-input">
    <div class="change">
      <input type="radio" id="login" value="login" v-model="mode">
      <label for="login" class="change__login">login</label>
      <input type="radio" id="addUser" value="addUser" v-model="mode">
      <label for="addUser" class="change__add-user">addUser</label>
    </div>
    <form id="form">
      <div class="form__contents">
        <p class="form__title">
          User ID
          <span v-show="userValidation.id">OK!</span>
        </p>
        <input type="text" v-model="User.id" placeholder="User ID">
      </div>
      <div v-show="addUserMode" class="form__contents">
        <p class="form__title">
          Email
          <span v-show="userValidation.email">OK!</span>
        </p>
        <input type="email" v-model="User.email" placeholder="Email">
      </div>
      <div class="form__contents">
        <p class="form__title">
          Password
          <span v-show="userValidation.lengthPassword">OK!</span>
        </p>
        <input type="password" v-model="User.password" placeholder="Password">
      </div>
      <div v-show="addUserMode" class="form__contents">
        <p class="form__title">
          Re Password
          <span v-show="userValidation.rePassword">OK!</span>
        </p>
        <input type="password" v-model="User.rePassword" placeholder="Re Password">
      </div>
      <div v-show="!addUserMode">
        <input class="login-button" type="submit" value="Login" v-on:click.prevent="login">
        <p v-if="showError">Error Text {{errorMessage}}</p>
      </div>
      <div v-show="addUserMode" >
        <input class="add-button" type="submit" value="Add User" v-on:click.prevent="addUser">
        <p v-if="showAddUserSuccess">Add User Success!</p>
      </div>
    </form>
  </div>
</template>

<style scoped>
  input[type="radio"] {
    display: none;
  }
  input[type="text"], input[type="password"], input[type="email"] {
    border: 1px solid #e5e5e5;
    width: 100%;
    height: 40px;
  }
  #form {
    padding: 20px 10px 10px;
  }
  .user-input {
    border: 1px solid #e5e5e5;
  }
  .change {
    display: table;
    width: 100%;
    height: 40px;
    color: #000;
  }
  .change__login, .change__add-user {
    display: table-cell;
    width: 50%;
    background-color: #D8D8D8;
    vertical-align: middle;
  }
  input[type=radio]:checked + label {
    background-color: #D9534F;
  }
  .form__contents {
    padding-bottom: 10px;
  }
  .form__title {
    font-size: 14px;
    margin: 0;
    text-align: left;
    padding-bottom: 3px;
  }
  .login-button, .add-button {
    background: #00CDFF;
    border: none;
    height: 40px;
    padding: 0;
    width: 100%;
    display: block;
    margin: auto;
  }
</style>

<script>
  var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  export default {
    data() {
      return {
        User: {
          id: '',
          email: '',
          password: '',
          rePassword: '',
        },
        showError: false,
        errorMessage: '',
        showAddUserSuccess: false,
        mode: 'login',
        minPasswordLength: 8,
      }
    },
    computed: {
      loginValidation() {
        return {
          id: !!this.User.id.trim(),
          password: !!this.User.password.trim(),
          lengthPassword: this.User.password.length >= this.minPasswordLength
        }
      },
      userValidation() {
        return {
          id: !!this.User.id.trim(),
          email: emailRE.test(this.User.email),
          password: !!this.User.password.trim(),
          lengthPassword: this.User.password.length >= this.minPasswordLength,
          rePassword: this.User.rePassword.length >= this.minPasswordLength && this.User.password === this.User.rePassword,
          equalPassword: this.User.password === this.User.rePassword
        }
      },
      addUserMode() {
        return this.mode === 'addUser';
      }
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