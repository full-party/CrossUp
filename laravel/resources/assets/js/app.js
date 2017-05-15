import Vue from 'vue'
import router from './router'

window.axios = require('axios');
 
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.component('app-header', require('./components/common/app-header.vue'));

const app = new Vue({
    router,
    el: '#app',
});