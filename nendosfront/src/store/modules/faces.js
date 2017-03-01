import * as types from '../mutation-types.js'

const state = {
  faces: []
}

const getters = {
  faces (state) {
    return state.faces
  }
}

const mutations = {
  [types.SET_FACES] (state, faces) {
    state.faces = faces
  }
}

const actions = {
  setFaces (store, faces) {
    store.commit(types.SET_FACES, faces)
  },
  retrieveFaces (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('faces', {
        before (request) {
          if (this.previousFacesRequest) {
            this.previousFacesRequest.abort()
          }
          this.previousFacesRequest = request
        }
      }).then((response) => {
        store.dispatch('setFaces', response.data)
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
