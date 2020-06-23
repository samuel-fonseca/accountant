/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import store from '@/vue/store/index';
import router from '@/vue/router/index';
import filters from '@/vue/filters';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import App from '@/views/App';

Vue.component('display-error', require(`@components/Errors.vue`).default);

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Object.keys(filters).forEach(f => {
  Vue.filter(f, filters[f]);
});

export const app = new Vue({
  data: { loading: false },
  el: '#app',
  components: {'App': App},
  store,
  router
});
