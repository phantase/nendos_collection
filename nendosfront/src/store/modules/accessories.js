import * as types from '../mutation-types.js'

const state = {
  accessories: []
}

const getters = {
  accessories (state) {
    return state.accessories
  }
}

const mutations = {
  [types.SET_ACCESSORIES] (state, accessories) {
    state.accessories = accessories
  }
}

const actions = {
  setAccessories (store, accessories) {
    store.commit(types.SET_ACCESSORIES, accessories)
  },
  retrieveAccessories (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('accessories', {
        before (request) {
          if (this.previousAccessoriesRequest) {
            this.previousAccessoriesRequest.abort()
          }
          this.previousAccessoriesRequest = request
        }
      }).then((response) => {
        store.dispatch('setAccessories', response.data)
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
