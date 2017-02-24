import * as types from '../mutation-types.js'

const state = {
  boxes: []
}

const getters = {
  boxes (state) {
    return state.boxes
  }
}

const mutations = {
  [types.SET_BOXES] (state, boxes) {
    state.boxes = boxes
  }
}

const actions = {
  setBoxes (store, boxes) {
    store.commit(types.SET_BOXES, boxes)
  },
  retrieveBoxes (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('boxes').then((response) => {
        store.dispatch('setBoxes', response.data)
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
