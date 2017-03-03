import * as types from '../mutation-types.js'

const state = {
  nendoroids: []
}

const getters = {
  nendoroids (state) {
    return state.nendoroids
  }
}

const mutations = {
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
  }
}

const actions = {
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
