<template>
  <section>
    <h1>Setting Address</h1>
    <form id="form">
      <input type="email" v-model="email" placeholder="Email">
      <p v-show="!emailValidation.validationRe">Please Input Email</p>
      <p v-show="emailValidation.validationRe">Email OK!</p>
      <router-link to="/setting">back</router-link>
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