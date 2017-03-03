import * as types from '../mutation-types.js'

const state = {
  user: [],
  authenticated: false,
  token: null
}

const getters = {
  user (state) {
    return state.user
  },
  authenticated (state) {
    return state.authenticated
  },
  token (state) {
    return state.token
  },
  viewvalidation (state) {
    return state.user.administrator === '1' || state.user.validator === '1' || state.user.editor === '1'
  },
  canvalidate (state) {
    return state.user.administrator === '1' || state.user.validator === '1'
  }
}

const mutations = {
  [types.SET_USER] (state, user) {
    state.user = user
  },
  [types.SET_AUTHENTICATED] (state, authenticated) {
    state.authenticated = authenticated
  },
  [types.SET_TOKEN] (state, token) {
    state.token = token
  }
}

const actions = {
  setUser (store, user) {
    store.commit(types.SET_USER, user)
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
    store.commit(types.SET_AUTHENTICATED, authenticated)
  },
  setToken (store, token) {
    localStorage.setItem('token', token)
    store.commit(types.SET_TOKEN, token)
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
  },
  logout (store) {
    return new Promise((resolve, reject) => {
      store.commit(types.SET_USER, [])
      store.commit(types.SET_AUTHENTICATED, null)
      store.commit(types.SET_TOKEN, null)
      localStorage.removeItem('token')
      resolve()
    })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
