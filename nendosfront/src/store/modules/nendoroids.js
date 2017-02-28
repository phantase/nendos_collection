import * as types from '../mutation-types.js'

const state = {
  nendoroids: []
}

const getters = {
  nendoroids (state) {
    return state.nendoroids
  }
}

const mutations = {
  [types.SET_NENDOROIDS] (state, nendoroids) {
    state.nendoroids = nendoroids
  }
}

const actions = {
  setNendoroids (store, nendoroids) {
    store.commit(types.SET_NENDOROIDS, nendoroids)
  },
  retrieveNendoroids (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroids', {
        before (request) {
          if (this.previousNendoroidsRequest) {
            this.previousNendoroidsRequest.abort()
          }
          this.previousNendoroidsRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
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
