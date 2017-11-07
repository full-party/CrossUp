import Vue from 'vue';
import store from './store';
import router from './router';

window.axios = require('axios');
 
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

// LSにgame情報が存在する時、LSから取り出しstateに格納する
if(localStorage.getItem('game') !== null) {
  const game = JSON.parse(localStorage.getItem('game'));
  store.dispatch('setGame', game);
}

const app = new Vue({
    router,
    el: '#app',
    store,
});