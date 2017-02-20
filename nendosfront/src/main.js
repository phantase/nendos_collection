// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App'
import router from './router'
import resources from './config/resources'

import auth from './auth'

Vue.use(VueResource)
Vue.http.options.root = resources.apiurl
Vue.http.interceptors.push(function (request, next) {
  if (auth.user.authenticated) {
    request.headers.set('Authorization', 'Bearer ' + auth.getToken())
  }
  next()
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
