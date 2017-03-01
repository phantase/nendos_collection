import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import auth from './modules/auth'
import counts from './modules/counts'
import boxes from './modules/boxes'
import nendoroids from './modules/nendoroids'
import faces from './modules/faces'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  actions,
  modules: {
    auth,
    counts,
    boxes,
    nendoroids,
    faces
  },
  strict: debug
})
