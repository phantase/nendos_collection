import * as types from '../mutation-types.js'

const state = {
  bodyparts: []
}

const getters = {
  bodyparts (state) {
    return state.bodyparts
  },
  countbodyparts (state) {
    return state.bodyparts.length
  },
  countuserbodyparts (state) {
    return state.bodyparts.filter(bodypart => bodypart.collquantity).length
  }
}

const mutations = {
  [types.ADD_BODYPART] (state, bodypart) {
    state.bodyparts.push(bodypart)
  },
  [types.EDIT_BODYPART] (state, bodypart) {
    let idx = state.bodyparts.findIndex(intbodypart => intbodypart.internalid === bodypart.internalid)
    state.bodyparts[idx] = bodypart
  },
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
  },
  [types.VALIDATE_BODYPART] (state, payload) {
    let bodypartid = payload.bodypartid
    let userid = payload.userid
    let username = payload.username
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validatorid = userid
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validatorname = username
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_BODYPART] (state, bodypartid) {
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validatorid = null
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validatorname = null
    state.bodyparts.filter(bodypart => bodypart.internalid === bodypartid)[0].validationdate = null
  },
  [types.ADD_BODYPART_PICTURE] (state, internalid) {
    let idx = state.bodyparts.findIndex(intbodypart => intbodypart.internalid === internalid)
    state.bodyparts[idx].haspicture = 1
  }
}

const actions = {
  addBodypart (store, bodypart) {
    store.commit(types.ADD_BODYPART, bodypart)
  },
  editBodypart (store, bodypart) {
    store.commit(types.EDIT_BODYPART, bodypart)
  },
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
  },
  validateBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/validate').then(response => {
        store.commit(types.VALIDATE_BODYPART, {
          'bodypartid': bodypartid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_BODYPART, bodypartid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createBodypart (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('bodypart', formData).then(response => {
        store.dispatch('addBodypart', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateBodypart (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('bodypart/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editBodypart', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addBodypartPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_BODYPART_PICTURE, internalid)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
