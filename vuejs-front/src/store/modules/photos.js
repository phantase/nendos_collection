import * as types from '../mutation-types.js'

const state = {
  photos: [],
  photoaccessories: [],
  photobodyparts: [],
  photoboxes: [],
  photofaces: [],
  photohairs: [],
  photohands: [],
  photonendoroids: [],
  photosLoadedDate: null,
  photoaccessoriesLoadedDate: null,
  photobodypartsLoadedDate: null,
  photoboxesLoadedDate: null,
  photofacesLoadedDate: null,
  photohairsLoadedDate: null,
  photohandsLoadedDate: null,
  photonendoroidsLoadedDate: null,
  photosTagsCodeList: []
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
  },
  photosLoadedDate (state) {
    return state.photosLoadedDate
  },
  photoaccessoriesLoadedDate (state) {
    return state.photoaccessoriesLoadedDate
  },
  photobodypartsLoadedDate (state) {
    return state.photobodypartsLoadedDate
  },
  photoboxesLoadedDate (state) {
    return state.photoboxesLoadedDate
  },
  photofacesLoadedDate (state) {
    return state.photofacesLoadedDate
  },
  photohairsLoadedDate (state) {
    return state.photohairsLoadedDate
  },
  photohandsLoadedDate (state) {
    return state.photohandsLoadedDate
  },
  photonendoroidsLoadedDate (state) {
    return state.photonendoroidsLoadedDate
  },
  photosTagsCodeList (state) {
    return state.photosTagsCodeList
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
    state.photosLoadedDate = new Date()
  },
  [types.FAVORITE_PHOTO] (state, photoid) {
    state.photos.find(photo => photo.internalid === photoid).numberfavorited++
    state.photos.find(photo => photo.internalid === photoid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_PHOTO] (state, photoid) {
    state.photos.find(photo => photo.internalid === photoid).numberfavorited--
    state.photos.find(photo => photo.internalid === photoid).inuserfavorites = null
  },
  [types.ADD_PHOTOACCESSORY] (state, photoaccessory) {
    state.photoaccessories.push(photoaccessory)
  },
  [types.EDIT_PHOTOACCESSORY] (state, photoaccessory) {
    let idx = state.photoaccessories.findIndex(intpe => intpe.internalid === photoaccessory.internalid)
    state.photoaccessories[idx] = photoaccessory
  },
  [types.SET_PHOTOACCESSORIES] (state, photoaccessories) {
    state.photoaccessories = photoaccessories
    state.photoaccessoriesLoadedDate = new Date()
  },
  [types.ADD_PHOTOBODYPART] (state, photobodypart) {
    state.photobodyparts.push(photobodypart)
  },
  [types.EDIT_PHOTOBODYPART] (state, photobodypart) {
    let idx = state.photobodyparts.findIndex(intpe => intpe.internalid === photobodypart.internalid)
    state.photobodyparts[idx] = photobodypart
  },
  [types.SET_PHOTOBODYPARTS] (state, photobodyparts) {
    state.photobodyparts = photobodyparts
    state.photobodypartsLoadedDate = new Date()
  },
  [types.ADD_PHOTOBOX] (state, photobox) {
    state.photoboxes.push(photobox)
  },
  [types.EDIT_PHOTOBOX] (state, photobox) {
    let idx = state.photoboxes.findIndex(intpe => intpe.internalid === photobox.internalid)
    state.photoboxes[idx] = photobox
  },
  [types.SET_PHOTOBOXES] (state, photoboxes) {
    state.photoboxes = photoboxes
    state.photoboxesLoadedDate = new Date()
  },
  [types.ADD_PHOTOFACE] (state, photoface) {
    state.photofaces.push(photoface)
  },
  [types.EDIT_PHOTOFACE] (state, photoface) {
    let idx = state.photofaces.findIndex(intpe => intpe.internalid === photoface.internalid)
    state.photofaces[idx] = photoface
  },
  [types.SET_PHOTOFACES] (state, photofaces) {
    state.photofaces = photofaces
    state.photofacesLoadedDate = new Date()
  },
  [types.ADD_PHOTOHAIR] (state, photohair) {
    state.photohairs.push(photohair)
  },
  [types.EDIT_PHOTOHAIR] (state, photohair) {
    let idx = state.photohairs.findIndex(intpe => intpe.internalid === photohair.internalid)
    state.photohairs[idx] = photohair
  },
  [types.SET_PHOTOHAIRS] (state, photohairs) {
    state.photohairs = photohairs
    state.photohairsLoadedDate = new Date()
  },
  [types.ADD_PHOTOHAND] (state, photohand) {
    state.photohands.push(photohand)
  },
  [types.EDIT_PHOTOHAND] (state, photohand) {
    let idx = state.photohands.findIndex(intpe => intpe.internalid === photohand.internalid)
    state.photohands[idx] = photohand
  },
  [types.SET_PHOTOHANDS] (state, photohands) {
    state.photohands = photohands
    state.photohandsLoadedDate = new Date()
  },
  [types.ADD_PHOTONENDOROID] (state, photonendoroid) {
    state.photonendoroids.push(photonendoroid)
  },
  [types.EDIT_PHOTONENDOROID] (state, photonendoroid) {
    let idx = state.photonendoroids.findIndex(intpe => intpe.internalid === photonendoroid.internalid)
    state.photonendoroids[idx] = photonendoroid
  },
  [types.SET_PHOTONENDOROIDS] (state, photonendoroids) {
    state.photonendoroids = photonendoroids
    state.photonendoroidsLoadedDate = new Date()
  },
  [types.SET_PHOTOS_TAGS_CODELIST] (state, tags) {
    state.photosTagsCodeList = tags
  },
  [types.TAG_PHOTO] (state, payload) {
    let photoid = payload.photoid
    let tag = payload.tag
    console.log(photoid)
    console.log(tag)
    if (state.photos.find(photo => photo.internalid === photoid).tags) {
      state.photos.find(photo => photo.internalid === photoid).tags.push({'tag': tag})
    } else {
      state.photos.find(photo => photo.internalid === photoid).tags = [{'tag': tag}]
    }
  }
}

const actions = {
  addPhoto (store, photo) {
    // store.dispatch('addPhotoToIndex', photo)
    store.commit(types.ADD_PHOTO, photo)
  },
  editPhoto (store, photo) {
    // store.dispatch('editPhotoToIndex', photo)
    store.commit(types.EDIT_PHOTO, photo)
  },
  setPhotos (store, photos) {
    // photos.forEach((photo) => {
    //   store.dispatch('addPhotoToIndex', photo)
    // })
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
  favoritePhoto (store, payload) {
    let context = payload.context
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.patch('photos/' + photoid + '/favorite').then(response => {
        store.commit(types.FAVORITE_PHOTO, photoid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoritePhoto (store, payload) {
    let context = payload.context
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.patch('photos/' + photoid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_PHOTO, photoid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  addPhotoAccessory (store, photoaccessory) {
    store.commit(types.ADD_PHOTOACCESSORY, photoaccessory)
  },
  editPhotoAccessory (store, photoaccessory) {
    store.commit(types.EDIT_PHOTOACCESSORY, photoaccessory)
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
  addPhotoBodypart (store, photobodypart) {
    store.commit(types.ADD_PHOTOBODYPART, photobodypart)
  },
  editPhotoBodypart (store, photobodypart) {
    store.commit(types.EDIT_PHOTOBODYPART, photobodypart)
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
  addPhotoBox (store, photobox) {
    store.commit(types.ADD_PHOTOBOX, photobox)
  },
  editPhotoBox (store, photobox) {
    store.commit(types.EDIT_PHOTOBOX, photobox)
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
  addPhotoFace (store, photoface) {
    store.commit(types.ADD_PHOTOFACE, photoface)
  },
  editPhotoFace (store, photoface) {
    store.commit(types.EDIT_PHOTOFACE, photoface)
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
  addPhotoHair (store, photohair) {
    store.commit(types.ADD_PHOTOHAIR, photohair)
  },
  editPhotoHair (store, photohair) {
    store.commit(types.EDIT_PHOTOHAIR, photohair)
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
  addPhotoHand (store, photohand) {
    store.commit(types.ADD_PHOTOHAND, photohand)
  },
  editPhotoHand (store, photohand) {
    store.commit(types.EDIT_PHOTOHAND, photohand)
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
  addPhotoNendoroid (store, photonendoroid) {
    store.commit(types.ADD_PHOTONENDOROID, photonendoroid)
  },
  editPhotoNendoroid (store, photonendoroid) {
    store.commit(types.EDIT_PHOTONENDOROID, photonendoroid)
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
  },
  createPhotoAccessory (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/accessory', formData).then(response => {
        store.dispatch('addPhotoAccessory', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoBodypart (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/bodypart', formData).then(response => {
        store.dispatch('addPhotoBodypart', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoBox (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/box', formData).then(response => {
        store.dispatch('addPhotoBox', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoFace (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/face', formData).then(response => {
        store.dispatch('addPhotoFace', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoHair (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/hair', formData).then(response => {
        store.dispatch('addPhotoHair', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoHand (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/hand', formData).then(response => {
        store.dispatch('addPhotoHand', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  createPhotoNendoroid (store, payload) {
    let context = payload.context
    let formData = payload.formData
    let photoid = payload.photoid
    return new Promise((resolve, reject) => {
      context.$http.post('photo/' + photoid + '/nendoroid', formData).then(response => {
        store.dispatch('addPhotoNendoroid', response.data)
        resolve(response.data.photoid)
      }, response => {
        reject()
      })
    })
  },
  setPhotosTagsCodeList (store, tags) {
    store.commit(types.SET_PHOTOS_TAGS_CODELIST, tags)
  },
  retrievePhotosTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('photos/tags', {
        before (request) {
          if (this.previousPhotosTagsCodeListRequest) {
            this.previousPhotosTagsCodeListRequest.abort()
          }
          this.previousPhotosTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setPhotosTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagPhoto (store, payload) {
    let context = payload.context
    let photoid = payload.photoid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('photos/' + photoid + '/tag', formData).then(response => {
        store.commit(types.TAG_PHOTO, payload)
        resolve()
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
