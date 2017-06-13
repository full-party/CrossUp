<template>
  <section>
    <h1>Setting Password</h1>
      <form id="form">
        <input type="password" v-model="password" placeholder="Password">
        <p v-show="!passwordValidation.password">Please Input Password</p>
        <p v-show="passwordValidation.password">Password OK!</p>
        <input type="password" v-model="rePassword" placeholder="Re Password">
        <p v-show="!passwordValidation.rePassword">Please Input Re Password</p>
        <p v-show="passwordValidation.rePassword">Re Password OK!</p>
        <router-link to="/setting">setting</router-link>
        <input type="submit" value="Change" v-on:click.prevent="change">
      </form>
  </section>
</template>

<style scoped>
  h1 {
    color: red;
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
          console.log('true');
        } else {
          console.log('false');
        }
      },
    },
  }
</script>