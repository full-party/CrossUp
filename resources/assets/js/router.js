import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

import header from './components/common/app-header.vue';

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: require('./components/views/top.vue') },
    { path: '/setting',
      components: {
        default: require('./components/views/setting/setting.vue'),
        header: header
      }
    },
    { path: '/setting/id',
      components: {
        dafault: require('./components/views/setting/id.vue'),
        header: header
      }
    },
    { path: '/setting/address',
      components: {
        default: require('./components/views/setting/address.vue'),
        header: header
      }
    },
    { path: '/setting/password',
      components: {
        default: require('./components/views/setting/password.vue'),
        header: header
      }
    },
    { path: '/setting/delete/id',
      components: {
        default:require('./components/views/setting/deleteId.vue'),
        header: header
      }
    },
    { path: '/games',
      components: {
        default: require('./components/views/games.vue'),
        header: header
      }
    },
    { path: '/combos',
      components: {
        default: require('./components/views/combo/comboList.vue'),
        header: header
      }
    },
    { path: '/combos/create',
      components: {
        default: require('./components/views/combo/comboCreate.vue'),
        header: header
      }
    },
    { path: '/combos/:id',
      components: {
        default: require('./components/views/combo/comboDetail.vue'),
        header: header
      }
    },
    { path: '/combos/:id/edit',
      components: {
        default: require('./components/views/combo/comboEdit.vue'),
        header: header
      }
    },
  ],
});