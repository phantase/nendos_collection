import * as types from '../mutation-types.js'

const state = {
  faces: []
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
  }
}

const mutations = {
  [types.SET_FACES] (state, faces) {
    state.faces = faces
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
