<template>
  <section>
    <h1>Setting Id</h1>
    <input type="text" v-model="id" placeholder="User ID">
    <p v-show="!idValidation.validationEmpty">Please Input User ID</p>
    <p class="error" v-show="idValidation.validationEmpty && !idValidation.validationRe">Error alphanumeric Only!</p>
    <p v-show="idValidation.validationRe">User ID OK!</p>
    <router-link to="/setting">back</router-link>
    <button v-bind:disabled="!idValidation.validationEmpty || !idValidation.validationRe" @click="change()">change</button>
  </section>
</template>

<style scoped>
  h1, .error {
    color: red;
  }
</style>

<script>
  const userIdRE = /^[a-zA-Z0-9]+$/;

  export default {
    data() {
      return {
        id: '',
      }
    },
    computed: {
      idValidation() {
        return {
          validationRe: userIdRE.test(this.id),
          validationEmpty: !!this.id.trim(),
        }
      },
    },
    methods: {
      change(){
        if (this.idValidation.validationRe) {
          console.log(true);
        } else {
          console.log(false);
        }
      }
    }
  };
</script>