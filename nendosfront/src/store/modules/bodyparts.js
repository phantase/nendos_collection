import * as types from '../mutation-types.js'

const state = {
  bodyparts: []
}

const getters = {
  bodyparts (state) {
    return state.bodyparts
  }
}

const mutations = {
  [types.SET_BODYPARTS] (state, bodyparts) {
    state.bodyparts = bodyparts
  },
  [types.COLLECT_BODYPART] (state, bodypartid) {
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].collquantity++
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_BODYPART] (state, bodypartid) {
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].collquantity--
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].colladdeddate = 'NOW'
  }
}

const actions = {
  setBodyparts (store, bodyparts) {
    store.commit(types.SET_BODYPARTS, bodyparts)
  },
  retrieveBodyparts (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('bodyparts', {
        before (request) {
          if (this.previousBodypartsRequest) {
            this.previousBodypartsRequest.abort()
          }
          this.previousBodypartsRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodyparts', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/collect').then(response => {
        store.commit(types.COLLECT_BODYPART, bodypartid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_BODYPART, bodypartid)
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
