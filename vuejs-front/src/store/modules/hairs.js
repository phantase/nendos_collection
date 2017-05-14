import * as types from '../mutation-types.js'

const state = {
  hairs: []
}

const getters = {
  hairs (state) {
    return state.hairs
  },
  counthairs (state) {
    return state.hairs.length
  },
  countuserhairs (state) {
    return state.hairs.filter(hair => hair.collquantity).length
  }
}

const mutations = {
  [types.ADD_HAIR] (state, hair) {
    state.hairs.push(hair)
  },
  [types.EDIT_HAIR] (state, hair) {
    let idx = state.hairs.findIndex(inthair => inthair.internalid === hair.internalid)
    state.hairs[idx] = hair
  },
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
  },
  [types.VALIDATE_HAIR] (state, payload) {
    let hairid = payload.hairid
    let userid = payload.userid
    let username = payload.username
    state.hairs.filter(hair => hair.internalid === hairid)[0].validatorid = userid
    state.hairs.filter(hair => hair.internalid === hairid)[0].validatorname = username
    state.hairs.filter(hair => hair.internalid === hairid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_HAIR] (state, hairid) {
    state.hairs.filter(hair => hair.internalid === hairid)[0].validatorid = null
    state.hairs.filter(hair => hair.internalid === hairid)[0].validatorname = null
    state.hairs.filter(hair => hair.internalid === hairid)[0].validationdate = null
  },
  [types.ADD_HAIR_PICTURE] (state, internalid) {
    let idx = state.hairs.findIndex(inthair => inthair.internalid === internalid)
    state.hairs[idx].haspicture = 1
  }
}

const actions = {
  addHair (store, hair) {
    store.commit(types.ADD_HAIR, hair)
  },
  editHair (store, hair) {
    store.commit(types.EDIT_HAIR, hair)
  },
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
  },
  validateHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.patch('hairs/' + hairid + '/validate').then(response => {
        store.commit(types.VALIDATE_HAIR, {
          'hairid': hairid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.patch('hairs/' + hairid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_HAIR, hairid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createHair (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('hair', formData).then(response => {
        store.dispatch('addHair', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateHair (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('hair/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editHair', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addHairPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_HAIR_PICTURE, internalid)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
