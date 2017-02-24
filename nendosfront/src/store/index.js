import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import boxes from './modules/boxes'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    boxes
  },
  strict: true
})
