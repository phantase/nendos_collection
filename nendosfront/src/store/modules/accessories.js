import * as types from '../mutation-types.js'

const state = {
  accessories: []
}

const getters = {
  accessories (state) {
    return state.accessories
  }
}

const mutations = {
  [types.SET_ACCESSORIES] (state, accessories) {
    state.accessories = accessories
  },
  [types.COLLECT_ACCESSORY] (state, accessoryid) {
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].collquantity++
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_ACCESSORY] (state, accessoryid) {
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].collquantity--
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].colladdeddate = 'NOW'
  }
}

const actions = {
  setAccessories (store, accessories) {
    store.commit(types.SET_ACCESSORIES, accessories)
  },
  retrieveAccessories (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('accessories', {
        before (request) {
          if (this.previousAccessoriesRequest) {
            this.previousAccessoriesRequest.abort()
          }
          this.previousAccessoriesRequest = request
        }
      }).then((response) => {
        store.dispatch('setAccessories', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/collect').then(response => {
        store.commit(types.COLLECT_ACCESSORY, accessoryid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_ACCESSORY, accessoryid)
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
