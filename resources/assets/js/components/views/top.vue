<template>
  <section>
    <h1>Cross Up</h1>
    <form id="form">
      <div>
        <input type="text" v-model="User.id" placeholder="User ID">
        <p v-show="!userValidation.id">Please Input User ID</p>
        <p v-show="userValidation.id">User ID OK!</p>
      </div>
      <div v-show="addUserMode">
        <input type="email" v-model="User.email" placeholder="Email">
        <p v-show="!userValidation.email">Please Input Email</p>
        <p v-show="userValidation.email">Email OK!</p>
      </div>
      <div>
        <input type="password" v-model="User.password" placeholder="Password">
        <p v-show="!userValidation.password">Please Input Password</p>
        <p v-show="userValidation.password">Password OK!</p>
      </div>
      <div v-show="addUserMode">
        <input type="password" v-model="User.rePassword" placeholder="Re Password">
        <p v-show="!userValidation.rePassword">Please Input Re Password</p>
        <p v-show="userValidation.rePassword">Re Password OK!</p>
      </div>
      <div v-show="!addUserMode">
        <input type="submit" value="Login" v-on:click.prevent="login">
        <p v-if="showError">Error Text {{errorMessage}}</p>
      </div>
      <div v-show="addUserMode" >
        <input type="submit" value="Add User" v-on:click.prevent="addUser">
        <p v-if="showAddUserSuccess">Add User Success!</p>
      </div>
    </form>
    <input type="radio" id="login" value="login" v-model="mode">
    <label for="login">login</label>
    <input type="radio" id="addUser" value="addUser" v-model="mode">
    <label for="addUser">addUser</label>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
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
            loginId: this.User.id,
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