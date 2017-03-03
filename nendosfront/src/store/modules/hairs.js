import * as types from '../mutation-types.js'

const state = {
  hairs: []
}

const getters = {
  hairs (state) {
    return state.hairs
  }
}

const mutations = {
  [types.SET_HAIRS] (state, hairs) {
    state.hairs = hairs
  },
  [types.COLLECT_HAIR] (state, hairid) {
    state.hairs.filter(hair => hair.internalid === hairid)[0].collquantity++
    state.hairs.filter(hair => hair.internalid === hairid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_HAIR] (state, hairid) {
    state.hairs.filter(hair => hair.internalid === hairid)[0].collquantity--
    state.hairs.filter(hair => hair.internalid === hairid)[0].colladdeddate = 'NOW'
  }
}

const actions = {
  setHairs (store, hairs) {
    store.commit(types.SET_HAIRS, hairs)
  },
  retrieveHairs (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('hairs', {
        before (request) {
          if (this.previousHairsRequest) {
            this.previousHairsRequest.abort()
          }
          this.previousHairsRequest = request
        }
      }).then((response) => {
        store.dispatch('setHairs', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.patch('hairs/' + hairid + '/collect').then(response => {
        store.commit(types.COLLECT_HAIR, hairid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.patch('hairs/' + hairid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_HAIR, hairid)
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
