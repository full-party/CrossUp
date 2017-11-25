<template>
  <section>
    <h1>ID変更</h1>
    <section class="id__edit">
      <p class="id_edit__title">
        User ID
        <span v-show="idValidation.validationRe">OK!</span>
      </p>
      <input type="text" v-model="id" placeholder="User ID">
      <div class="menu">
        <div class="menu__back">
          <router-link to="/setting" class="menu__back__button">キャンセル</router-link>
        </div>
        <div class="menu__update">
          <button v-bind:disabled="!idValidation.validationEmpty || !idValidation.validationRe" @click="change()" class="menu__update__button">変更</button>
        </div>
      </div>
    </section>
  </section>
</template>

<style scoped>
  h1, .error {
    padding: 0 0 10px 10px;
  }
  .id__edit {
    background-color: #fff;
    padding: 10px;
  }
  input[type="text"] {
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
          axios.put('/api/users/' + localStorage.getItem('id') , {login_id: this.id})
            .then(res => {
              console.log('ok')
            })
            .catch(err => {
              console.log('error');
            });
        } else {
          console.log(false);
        }
      }
    }
  };
</script>