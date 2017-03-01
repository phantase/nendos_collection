import * as types from '../mutation-types.js'

const state = {
  bodyparts: []
}

const getters = {
  bodyparts (state) {
    return state.bodyparts
  }
}

const mutations = {
  [types.SET_BODYPARTS] (state, bodyparts) {
    state.bodyparts = bodyparts
  }
}

const actions = {
  setBodyparts (store, bodyparts) {
    store.commit(types.SET_BODYPARTS, bodyparts)
  },
  retrieveBodyparts (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('bodyparts', {
        before (request) {
          if (this.previousBodypartsRequest) {
            this.previousBodypartsRequest.abort()
          }
          this.previousBodypartsRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodyparts', response.data)
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
