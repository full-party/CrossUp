<template>
  <section>
    <h1>Setting Id</h1>
    <input type="text" v-model="id" placeholder="User ID">
    <p v-show="isEmpty">Please Input User ID</p>
    <p class="error" v-show="!isEmpty && !idValidation">Error alphanumeric Only!</p>
    <p v-show="idValidation">User ID OK!</p>
    <router-link to="/setting">back</router-link>
    <router-link to="/setting">
      <button v-bind:disabled="isEmpty || !idValidation">
        change
      </button>
    </router-link>
  </section>
</template>

<style scoped>
  h1, .error {
    color: red;
  }
</style>

<script>
  var userIdRE = /^[a-zA-Z0-9]+$/;

  export default {
    data() {
      return {
        id: '',
      }
    },
    computed: {
      idValidation() {
        return userIdRE.test(this.id);
      },
      isEmpty() {
        return !this.id.trim();
      }
    }
  };
</script>