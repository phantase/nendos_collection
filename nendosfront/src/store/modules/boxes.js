import * as types from '../mutation-types.js'

const state = {
  boxes: []
}

const getters = {
  boxes (state) {
    return state.boxes
  },
  countboxes (state) {
    return state.boxes.length
  },
  countuserboxes (state) {
    return state.boxes.filter(box => box.collquantity).length
  }
}

const mutations = {
  [types.SET_BOXES] (state, boxes) {
    state.boxes = boxes
  },
  [types.COLLECT_BOX] (state, boxid) {
    state.boxes.filter(box => box.internalid === boxid)[0].collquantity++
    state.boxes.filter(box => box.internalid === boxid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_BOX] (state, boxid) {
    state.boxes.filter(box => box.internalid === boxid)[0].collquantity--
    state.boxes.filter(box => box.internalid === boxid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_BOX] (state, payload) {
    let boxid = payload.boxid
    let userid = payload.userid
    let username = payload.username
    state.boxes.filter(box => box.internalid === boxid)[0].validatorid = userid
    state.boxes.filter(box => box.internalid === boxid)[0].validatorname = username
    state.boxes.filter(box => box.internalid === boxid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_BOX] (state, boxid) {
    state.boxes.filter(box => box.internalid === boxid)[0].validatorid = null
    state.boxes.filter(box => box.internalid === boxid)[0].validatorname = null
    state.boxes.filter(box => box.internalid === boxid)[0].validationdate = null
  }
}

const actions = {
  setBoxes (store, boxes) {
    store.commit(types.SET_BOXES, boxes)
  },
  retrieveBoxes (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('boxes', {
        before (request) {
          if (this.previousBoxesRequest) {
            this.previousBoxesRequest.abort()
          }
          this.previousBoxesRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/collect').then(response => {
        store.commit(types.COLLECT_BOX, boxid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_BOX, boxid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  validateBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/validate').then(response => {
        store.commit(types.VALIDATE_BOX, {
          'boxid': boxid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_BOX, boxid)
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
