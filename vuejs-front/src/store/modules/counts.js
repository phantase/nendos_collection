import * as types from '../mutation-types.js'

const state = {
  counts: {
    boxes: null,
    nendoroids: null,
    faces: null,
    hairs: null,
    hands: null,
    bodyparts: null,
    accessories: null,
    photos: null
  },
  usercounts: {
    boxes: null,
    nendoroids: null,
    faces: null,
    hairs: null,
    hands: null,
    bodyparts: null,
    accessories: null,
    photos: null
  }
}

const getters = {
  counts (state) {
    return state.counts
  },
  usercounts (state) {
    return state.usercounts
  }
}

const mutations = {
  [types.SET_COUNTS] (state, counts) {
    state.counts = counts
  },
  [types.SET_USERCOUNTS] (state, usercounts) {
    state.usercounts = usercounts
  },
  [types.RESET_COUNTS] (state) {
    state.counts = {
      boxes: null,
      nendoroids: null,
      faces: null,
      hairs: null,
      hands: null,
      bodyparts: null,
      accessories: null,
      photos: null
    }
  },
  [types.RESET_USERCOUNTS] (state) {
    state.usercounts = {
      boxes: null,
      nendoroids: null,
      faces: null,
      hairs: null,
      hands: null,
      bodyparts: null,
      accessories: null,
      photos: null
    }
  }
}

const actions = {
  setCounts (store, counts) {
    store.commit(types.SET_COUNTS, counts)
  },
  setUserCounts (store, usercounts) {
    store.commit(types.SET_USERCOUNTS, usercounts)
  },
  resetCounts (store) {
    store.commit(types.RESET_COUNTS)
  },
  resetUserCounts (store) {
    store.commit(types.RESET_USERCOUNTS)
  },
  retrieveCounts (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('count', {
        before (request) {
          if (this.previousCountRequest) {
            this.previousCountRequest.abort()
          }
          this.previousCountRequest = request
        }
      }).then((response) => {
        store.dispatch('setCounts', response.data.counts)
        if (response.data.usercounts) {
          store.dispatch('setUserCounts', response.data.usercounts)
        }
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
