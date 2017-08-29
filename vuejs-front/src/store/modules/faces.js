import * as types from '../mutation-types.js'

const state = {
  faces: [],
  facesLoadedDate: null,
  facesLoadedPartially: false,
  facsTagsCodeList: []
}

const getters = {
  faces (state) {
    return state.faces
  },
  countfaces (state) {
    return state.faces.length
  },
  countuserfaces (state) {
    return state.faces.filter(face => face.collquantity).length
  },
  facesLoadedDate (state) {
    return state.facesLoadedDate
  },
  facesLoadedPartially (state) {
    return state.facesLoadedPartially
  },
  facesEyesCodeList (state) {
    return state.faces.map(a => a.eyes).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  facesEyesColorCodeList (state) {
    return state.faces.map(a => a.eyes_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  facesMouthCodeList (state) {
    return state.faces.map(a => a.mouth).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  facesSkinColorCodeList (state) {
    return state.faces.map(a => a.skin_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  facesSexCodeList (state) {
    return state.faces.map(a => a.sex).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  facesTagsCodeList (state) {
    return state.facesTagsCodeList
  }
}

const mutations = {
  [types.ADD_FACE] (state, face) {
    state.faces.push(face)
  },
  [types.EDIT_FACE] (state, face) {
    let idx = state.faces.findIndex(intface => intface.internalid === face.internalid)
    state.faces[idx] = face
  },
  [types.SET_FACES] (state, faces) {
    state.faces = faces
    state.facesLoadedDate = new Date()
  },
  [types.COLLECT_FACE] (state, faceid) {
    state.faces.filter(face => face.internalid === faceid)[0].collquantity++
    state.faces.filter(face => face.internalid === faceid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_FACE] (state, faceid) {
    state.faces.filter(face => face.internalid === faceid)[0].collquantity--
    state.faces.filter(face => face.internalid === faceid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_FACE] (state, payload) {
    let faceid = payload.faceid
    let userid = payload.userid
    let username = payload.username
    state.faces.filter(face => face.internalid === faceid)[0].validatorid = userid
    state.faces.filter(face => face.internalid === faceid)[0].validatorname = username
    state.faces.filter(face => face.internalid === faceid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_FACE] (state, faceid) {
    state.faces.filter(face => face.internalid === faceid)[0].validatorid = null
    state.faces.filter(face => face.internalid === faceid)[0].validatorname = null
    state.faces.filter(face => face.internalid === faceid)[0].validationdate = null
  },
  [types.FAVORITE_FACE] (state, faceid) {
    state.faces.find(face => face.internalid === faceid).numberfavorited++
    state.faces.find(face => face.internalid === faceid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_FACE] (state, faceid) {
    state.faces.find(face => face.internalid === faceid).numberfavorited--
    state.faces.find(face => face.internalid === faceid).inuserfavorites = null
  },
  [types.ADD_FACE_PICTURE] (state, internalid) {
    let idx = state.faces.findIndex(intface => intface.internalid === internalid)
    state.faces[idx].haspicture = 1
  },
  [types.SET_FACES_TAGS_CODELIST] (state, tags) {
    state.facesTagsCodeList = tags
  },
  [types.TAG_FACE] (state, payload) {
    let faceid = payload.faceid
    let tag = payload.tag
    console.log(faceid)
    console.log(tag)
    if (state.faces.find(face => face.internalid === faceid).tags) {
      state.faces.find(face => face.internalid === faceid).tags.push({'tag': tag})
    } else {
      state.faces.find(face => face.internalid === faceid).tags = [{'tag': tag}]
    }
  },
  [types.SET_FACES_PARTIAL] (state, isPartial) {
    state.facesLoadedPartially = isPartial
  }
}

const actions = {
  addFace (store, face) {
    // store.dispatch('addFaceToIndex', face)
    store.commit(types.ADD_FACE, face)
  },
  editFace (store, face) {
    // store.dispatch('editFaceToIndex', face)
    store.commit(types.EDIT_FACE, face)
  },
  setFaces (store, faces) {
    // faces.forEach((face) => {
    //   store.dispatch('addFaceToIndex', face)
    // })
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
        store.commit(types.SET_FACES_PARTIAL, false)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/collect').then(response => {
        store.commit(types.COLLECT_FACE, faceid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_FACE, faceid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  validateFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/validate').then(response => {
        store.commit(types.VALIDATE_FACE, {
          'faceid': faceid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_FACE, faceid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  favoriteFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/favorite').then(response => {
        store.commit(types.FAVORITE_FACE, faceid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.patch('faces/' + faceid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_FACE, faceid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createFace (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('face', formData).then(response => {
        store.dispatch('addFace', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateFace (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('face/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editFace', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addFacePicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_FACE_PICTURE, internalid)
  },
  setFacesTagsCodeList (store, tags) {
    store.commit(types.SET_FACES_TAGS_CODELIST, tags)
  },
  retrieveFacesTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('faces/tags', {
        before (request) {
          if (this.previousFacesTagsCodeListRequest) {
            this.previousFacesTagsCodeListRequest.abort()
          }
          this.previousFacesTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setFacesTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('faces/' + faceid + '/tag', formData).then(response => {
        store.commit(types.TAG_FACE, payload)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  retrieveSingleFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.get('face/' + faceid, {
        before (request) {
          if (this.previousSingleFaceRequest) {
            this.previousSingleFaceRequest.abort()
          }
          this.previousSingleFaceRequest = request
        }
      }).then((response) => {
        store.dispatch('setFaces', [response.data])
        store.commit(types.SET_FACES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveFacesForBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.get('box/' + boxid + '/faces', {
        before (request) {
          if (this.previousFacesForBoxRequest) {
            this.previousFacesForBoxRequest.abort()
          }
          this.previousFacesForBoxRequest = request
        }
      }).then((response) => {
        store.dispatch('setFaces', response.data)
        store.commit(types.SET_FACES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveFacesForNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroid/' + nendoroidid + '/faces', {
        before (request) {
          if (this.previousFacesForNendoroidRequest) {
            this.previousFacesForNendoroidRequest.abort()
          }
          this.previousFacesForNendoroidRequest = request
        }
      }).then((response) => {
        store.dispatch('setFaces', response.data)
        store.commit(types.SET_FACES_PARTIAL, true)
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
