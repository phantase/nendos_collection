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
  },
  [types.COLLECT_FACE] (state, faceid) {
    state.faces.filter(face => face.internalid === faceid)[0].collquantity++
    state.faces.filter(face => face.internalid === faceid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_FACE] (state, faceid) {
    state.faces.filter(face => face.internalid === faceid)[0].collquantity--
    state.faces.filter(face => face.internalid === faceid)[0].colladdeddate = 'NOW'
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
