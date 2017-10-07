<template>
  <section>
    <h1>Setting Address</h1>
    <form id="form">
      <input type="email" v-model="email" placeholder="Email">
      <p v-show="!emailValidation.validationRe">Please Input Email</p>
      <p v-show="emailValidation.validationRe">Email OK!</p>
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
          console.log('true');
        } else {
          console.log('false');
        }
      },
    },
  }
</script>