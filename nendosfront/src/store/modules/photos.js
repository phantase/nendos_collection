import * as types from '../mutation-types.js'

const state = {
  photos: [],
  photoaccessories: [],
  photobodyparts: [],
  photoboxes: [],
  photofaces: [],
  photohairs: [],
  photohands: [],
  photonendoroids: []
}

const getters = {
  photos (state) {
    return state.photos
  },
  photoaccessories (state) {
    return state.photoaccessories
  },
  photobodyparts (state) {
    return state.photobodyparts
  },
  photoboxes (state) {
    return state.photoboxes
  },
  photofaces (state) {
    return state.photofaces
  },
  photohairs (state) {
    return state.photohairs
  },
  photohands (state) {
    return state.photohands
  },
  photonendoroids (state) {
    return state.photonendoroids
  }
}

const mutations = {
  [types.SET_PHOTOS] (state, photos) {
    state.photos = photos
  },
  [types.SET_PHOTOACCESSORIES] (state, photoaccessories) {
    state.photoaccessories = photoaccessories
  },
  [types.SET_PHOTOBODYPARTS] (state, photobodyparts) {
    state.photobodyparts = photobodyparts
  },
  [types.SET_PHOTOBOXES] (state, photoboxes) {
    state.photoboxes = photoboxes
  },
  [types.SET_PHOTOFACES] (state, photofaces) {
    state.photofaces = photofaces
  },
  [types.SET_PHOTOHAIRS] (state, photohairs) {
    state.photohairs = photohairs
  },
  [types.SET_PHOTOHANDS] (state, photohands) {
    state.photohands = photohands
  },
  [types.SET_PHOTONENDOROIDS] (state, photonendoroids) {
    state.photonendoroids = photonendoroids
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
  },
  setPhotoAccessories (store, photoaccessories) {
    store.commit(types.SET_PHOTOACCESSORIES, photoaccessories)
  },
  retrievePhotoAccessories (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photoaccessories', {
        before (request) {
          if (this.previousPhotoAccessoriesRequest) {
            this.previousPhotoAccessoriesRequest.abort()
          }
          this.previousPhotoAccessoriesRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoAccessories', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoBodyparts (store, photobodyparts) {
    store.commit(types.SET_PHOTOBODYPARTS, photobodyparts)
  },
  retrievePhotoBodyparts (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photobodyparts', {
        before (request) {
          if (this.previousPhotoBodypartsRequest) {
            this.previousPhotoBodypartsRequest.abort()
          }
          this.previousPhotoBodypartsRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoBodyparts', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoBoxes (store, photoboxes) {
    store.commit(types.SET_PHOTOBOXES, photoboxes)
  },
  retrievePhotoBoxes (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photoboxes', {
        before (request) {
          if (this.previousPhotoBoxesRequest) {
            this.previousPhotoBoxesRequest.abort()
          }
          this.previousPhotoBoxesRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoBoxes', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoFaces (store, photofaces) {
    store.commit(types.SET_PHOTOFACES, photofaces)
  },
  retrievePhotoFaces (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photofaces', {
        before (request) {
          if (this.previousPhotoFacesRequest) {
            this.previousPhotoFacesRequest.abort()
          }
          this.previousPhotoFacesRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoFaces', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoHairs (store, photohairs) {
    store.commit(types.SET_PHOTOHAIRS, photohairs)
  },
  retrievePhotoHairs (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photohairs', {
        before (request) {
          if (this.previousPhotoHairsRequest) {
            this.previousPhotoHairsRequest.abort()
          }
          this.previousPhotoHairsRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoHairs', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoHands (store, photohands) {
    store.commit(types.SET_PHOTOHANDS, photohands)
  },
  retrievePhotoHands (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photohands', {
        before (request) {
          if (this.previousPhotoHandsRequest) {
            this.previousPhotoHandsRequest.abort()
          }
          this.previousPhotoHandsRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoHands', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  setPhotoNendoroids (store, photonendoroids) {
    store.commit(types.SET_PHOTONENDOROIDS, photonendoroids)
  },
  retrievePhotoNendoroids (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photonendoroids', {
        before (request) {
          if (this.previousPhotoNendoroidsRequest) {
            this.previousPhotoNendoroidsRequest.abort()
          }
          this.previousPhotoNendoroidsRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotoNendoroids', response.data)
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
