import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: require('./components/top.vue') },
    { path: '/setting', component: require('./components/setting/setting.vue') },
    { path: '/setting/id', component: require('./components/setting/id.vue') },
    { path: '/setting/address', component: require('./components/setting/address.vue') },
    { path: '/setting/password', component: require('./components/setting/password.vue') },
    { path: '/setting/delete/id', component: require('./components/setting/deleteId.vue') },
    { path: '/games', component: require('./components/games.vue') },
    { path: '/combos', component: require('./components/combo/comboList.vue') },
    { path: '/combos/create', component: require('./components/combo/comboCreate.vue') },
    { path: '/combos/:id', component: require('./components/combo/comboDetail.vue') },
    { path: '/combos/:id/edit', component: require('./components/combo/comboEdit.vue') },
  ],
});