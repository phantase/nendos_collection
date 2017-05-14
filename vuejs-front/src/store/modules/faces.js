import * as types from '../mutation-types.js'

const state = {
  faces: [],
  facesLoadedDate: null
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
  [types.ADD_FACE_PICTURE] (state, internalid) {
    let idx = state.faces.findIndex(intface => intface.internalid === internalid)
    state.faces[idx].haspicture = 1
  }
}

const actions = {
  addFace (store, face) {
    store.commit(types.ADD_FACE, face)
  },
  editFace (store, face) {
    store.commit(types.EDIT_FACE, face)
  },
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
