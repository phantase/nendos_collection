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
        store.dispatch('setUser', response.data)
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
    relogin (store, payload) {
      let context = payload.context
      let token = localStorage.getItem('token')
      return new Promise((resolve, reject) => {
        if (token) {
          console.log('Token found')
          context.$http.get('auth/relogin', {headers: {'Authorization': 'Bearer ' + token}}).then((response) => {
            store.dispatch('setAuthenticated', true)
            store.dispatch('setToken', response.data.token)
            store.dispatch('setUser', response.data.user)

            resolve()
          }, (response) => {
            localStorage.removeItem('token')
            reject()
          })
        } else {
          console.log('Token not found')
          reject()
        }
      })
    },
    login (store, payload) {
      let credentials = payload.credentials
      let context = payload.context
      return new Promise((resolve, reject) => {
        context.$http.post('auth/login', credentials).then((response) => {
          store.dispatch('setAuthenticated', true)
          store.dispatch('setToken', response.data.token)
          store.dispatch('setUser', response.data.user)

          resolve()
        }, (response) => {
          reject()
        })
      })
    }
  },
  strict: true
})
