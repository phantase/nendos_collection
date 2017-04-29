import * as types from '../mutation-types.js'

const state = {
  users: []
}

const getters = {
  users (state) {
    return state.users
  },
  countusers (state) {
    return state.users.length
  }
}

const mutations = {
  [types.SET_USERS] (state, users) {
    state.users = users
  }
}

const actions = {
  setUsers (store, users) {
    store.commit(types.SET_USERS, users)
  },
  retrieveUsers (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('users', {
        before (request) {
          if (this.previousUsersRequest) {
            this.previousUsersRequest.abort()
          }
          this.previousUsersRequest = request
        }
      }).then((response) => {
        store.dispatch('setUsers', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
