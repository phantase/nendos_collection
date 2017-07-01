// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import './lib/css'
import './lib/script'

import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'
import router from './router'
import resources from './config/resources'
import App from './App'

import store from './store'

Vue.use(Vuex)
Vue.use(VueResource)
Vue.http.options.root = resources.apiurl
Vue.http.interceptors.push(function (request, next) {
  if (store.getters.authenticated) {
    request.headers.set('Authorization', 'Bearer ' + store.getters.token)
    if (request.url.indexOf('auth') === -1) {
      request.url = 'auth/' + request.url
    }
  }
  next()
})
router.beforeEach((to, from, next) => {
  document.title = 'Nendoroids db / ' + to.name
  next()
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  // render: h => h(require('./App'))
  template: '<App/>',
  components: { App }
})
