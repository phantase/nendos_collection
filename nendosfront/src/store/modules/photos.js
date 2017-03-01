import * as types from '../mutation-types.js'

const state = {
  photos: []
}

const getters = {
  photos (state) {
    return state.photos
  }
}

const mutations = {
  [types.SET_PHOTOS] (state, photos) {
    state.photos = photos
  }
}

const actions = {
  setPhotos (store, photos) {
    store.commit(types.SET_PHOTOS, photos)
  },
  retrievePhotos (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photos', {
        before (request) {
          if (this.previousPhotosRequest) {
            this.previousPhotosRequest.abort()
          }
          this.previousPhotosRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotos', response.data)
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
