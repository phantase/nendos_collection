import * as types from '../mutation-types.js'

const state = {
  hands: []
}

const getters = {
  hands (state) {
    return state.hands
  }
}

const mutations = {
  [types.SET_HANDS] (state, hands) {
    state.hands = hands
  }
}

const actions = {
  setHands (store, hands) {
    store.commit(types.SET_HANDS, hands)
  },
  retrieveHands (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('hands', {
        before (request) {
          if (this.previousHandsRequest) {
            this.previousHandsRequest.abort()
          }
          this.previousHandsRequest = request
        }
      }).then((response) => {
        store.dispatch('setHands', response.data)
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
