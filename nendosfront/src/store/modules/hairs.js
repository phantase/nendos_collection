import * as types from '../mutation-types.js'

const state = {
  hairs: []
}

const getters = {
  hairs (state) {
    return state.hairs
  }
}

const mutations = {
  [types.SET_HAIRS] (state, hairs) {
    state.hairs = hairs
  }
}

const actions = {
  setHairs (store, hairs) {
    store.commit(types.SET_HAIRS, hairs)
  },
  retrieveHairs (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('hairs', {
        before (request) {
          if (this.previousHairsRequest) {
            this.previousHairsRequest.abort()
          }
          this.previousHairsRequest = request
        }
      }).then((response) => {
        store.dispatch('setHairs', response.data)
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
