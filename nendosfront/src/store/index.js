import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: [],
    authenticated: false,
    token: null
  },
  mutations: {
    SET_USER (state, user) {
      state.user = user
    },
    SET_AUTHENTICATED (state, authenticated) {
      state.authenticated = authenticated
    },
    SET_TOKEN (state, token) {
      state.token = token
    }
  },
  getters: {
    user (state) {
      return state.user
    },
    authenticated (state) {
      return state.authenticated
    },
    token (state) {
      return state.token
    }
  },
  actions: {
    setUser (store, user) {
      store.commit('SET_USER', user)
    },
    retrieveUser (store, payload) {
      let context = payload.context
      context.$http.get('auth/whoami').then((response) => {
        this.setUser(response.data)
      }, (response) => {
        console.log('DEBUG <faillure of whoami>')
        console.log(response)
      })
    },
    setAuthenticated (store, authenticated) {
      store.commit('SET_AUTHENTICATED', authenticated)
    },
    setToken (store, token) {
      localStorage.setItem('token', token)
      store.commit('SET_TOKEN', token)
    },
    login (store, payload) {
      let credentials = payload.credentials
      let context = payload.context
      return new Promise((resolve, reject) => {
        context.$http.post('auth/login', credentials).then((response) => {
          store.displatch('setAuthenticated', true)
          // setToken(response.data.token)
          // retrieveUser({'context': context})

          resolve()
        }, (response) => {
          reject()
        })
      })
    }
  },
  strict: true
})
