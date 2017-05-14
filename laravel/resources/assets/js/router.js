import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: require('./components/top.vue')},
    { path: '/games', component: require('./components/games.vue') },
    { path: '/combos', component: require('./components/combos.vue') },
    { path: '/combos/:id', component: require('./components/comboDetail.vue') },
  ],
});