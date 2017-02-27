import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import counts from './modules/counts'
import boxes from './modules/boxes'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    counts,
    boxes
  },
  strict: true
})
