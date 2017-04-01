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
  countphotos (state) {
    return state.photos.length
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
  [types.ADD_PHOTO] (state, photo) {
    state.photos.push(photo)
  },
  [types.EDIT_PHOTO] (state, photo) {
    let idx = state.photos.findIndex(intphoto => intphoto.internalid === photo.internalid)
    state.photos[idx] = photo
  },
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
  addPhoto (store, photo) {
    store.commit(types.ADD_PHOTO, photo)
  },
  editPhoto (store, photo) {
    store.commit(types.EDIT_PHOTO, photo)
  },
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
  },
  createPhoto (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('photo', formData).then(response => {
        store.dispatch('addPhoto', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updatePhoto (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('photo/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editPhoto', response.data)
        resolve(response.data.internalid)
      }, response => {
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
