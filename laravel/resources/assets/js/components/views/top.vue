<template>
  <section>
    <h1>Cross Up</h1>
    <form id="form">
      <div v-show="addUserMode">
        <input type="text" v-model="User.id" placeholder="User ID">
        <p v-show="!userValidation.id">Please Input User ID</p>
        <p v-show="userValidation.id">User ID OK!</p>
      </div>
      <div>
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
        <p v-if="showError">Error Text</p>
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
        showAddUserSuccess: false,
        mode: 'login'
      }
    },
    computed: {
      loginValidation() {
        return {
          email: emailRE.test(this.User.email),
          password: !!this.User.password.trim()
        }
      },
      userValidation() {
        return {
          id: !!this.User.id.trim(),
          email: emailRE.test(this.User.email),
          password: !!this.User.password.trim(),
          rePassword: !!this.User.rePassword.trim(),
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
          this.$router.push('games');
        } else {
          this.showError = true;
        }
      },
      addUser() {
        if(this.isValid(this.userValidation)) {
          this.showAddUserSuccess = true;
        } else {
        }
      }
    }
  }
</script>