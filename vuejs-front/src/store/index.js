import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import auth from './modules/auth'
import counts from './modules/counts'
import boxes from './modules/boxes'
import nendoroids from './modules/nendoroids'
import faces from './modules/faces'
import hairs from './modules/hairs'
import hands from './modules/hands'
import bodyparts from './modules/bodyparts'
import accessories from './modules/accessories'
import photos from './modules/photos'
import users from './modules/users'
import news from './modules/news'
import settings from './modules/settings'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  actions,
  modules: {
    auth,
    counts,
    boxes,
    nendoroids,
    faces,
    hairs,
    hands,
    bodyparts,
    accessories,
    photos,
    users,
    news,
    settings
  },
  strict: debug
})
