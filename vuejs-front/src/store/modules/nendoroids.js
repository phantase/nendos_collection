import * as types from '../mutation-types.js'

const state = {
  nendoroids: []
}

const getters = {
  nendoroids (state) {
    return state.nendoroids
  },
  countnendoroids (state) {
    return state.nendoroids.length
  },
  countusernendoroids (state) {
    return state.nendoroids.filter(nendoroid => nendoroid.collquantity).length
  }
}

const mutations = {
  [types.ADD_NENDOROID] (state, nendoroid) {
    state.nendoroids.push(nendoroid)
  },
  [types.EDIT_NENDOROID] (state, nendoroid) {
    let idx = state.nendoroids.findIndex(intnendoroid => intnendoroid.internalid === nendoroid.internalid)
    state.nendoroids[idx] = nendoroid
  },
  [types.SET_NENDOROIDS] (state, nendoroids) {
    state.nendoroids = nendoroids
  },
  [types.COLLECT_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].collquantity++
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].collquantity--
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_NENDOROID] (state, payload) {
    let nendoroidid = payload.nendoroidid
    let userid = payload.userid
    let username = payload.username
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorid = userid
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorname = username
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorid = null
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorname = null
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validationdate = null
  }
}

const actions = {
  addNendoroid (store, nendoroid) {
    store.commit(types.ADD_NENDOROID, nendoroid)
  },
  editNendoroid (store, nendoroid) {
    store.commit(types.EDIT_NENDOROID, nendoroid)
  },
  setNendoroids (store, nendoroids) {
    store.commit(types.SET_NENDOROIDS, nendoroids)
  },
  retrieveNendoroids (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroids', {
        before (request) {
          if (this.previousNendoroidsRequest) {
            this.previousNendoroidsRequest.abort()
          }
          this.previousNendoroidsRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/collect').then(response => {
        store.commit(types.COLLECT_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  validateNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/validate').then(response => {
        store.commit(types.VALIDATE_NENDOROID, {
          'nendoroidid': nendoroidid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createNendoroid (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('nendoroid', formData).then(response => {
        store.dispatch('addNendoroid', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateNendoroid (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('nendoroid/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editNendoroid', response.data)
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