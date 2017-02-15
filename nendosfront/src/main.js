// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueResource from 'vue-resource'
import App from './App'
import router from './router'
import resources from './config/resources'

Vue.use(VueResource)
Vue.http.options.root = resources.apiurl

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
