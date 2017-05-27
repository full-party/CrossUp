import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: require('./components/views/top.vue') },
    { path: '/setting', component: require('./components/views/setting/setting.vue') },
    { path: '/setting/id', component: require('./components/views/setting/id.vue') },
    { path: '/setting/address', component: require('./components/views/setting/address.vue') },
    { path: '/setting/password', component: require('./components/views/setting/password.vue') },
    { path: '/setting/delete/id', component: require('./components/views/setting/deleteId.vue') },
    { path: '/games', component: require('./components/views/games.vue') },
    { path: '/combos', component: require('./components/views/combo/comboList.vue') },
    { path: '/combos/create', component: require('./components/views/combo/comboCreate.vue') },
    { path: '/combos/:id', component: require('./components/views/combo/comboDetail.vue') },
    { path: '/combos/:id/edit', component: require('./components/views/combo/comboEdit.vue') },
  ],
});