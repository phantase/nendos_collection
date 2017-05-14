import * as types from '../mutation-types.js'

const state = {
  boxes: [],
  boxesLoadedDate: null
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
  },
  boxesLoadedDate (state) {
    return state.boxesLoadedDate
  }
}

const mutations = {
  [types.ADD_BOX] (state, box) {
    state.boxes.push(box)
  },
  [types.EDIT_BOX] (state, box) {
    let idx = state.boxes.findIndex(intbox => intbox.internalid === box.internalid)
    state.boxes[idx] = box
  },
  [types.SET_BOXES] (state, boxes) {
    state.boxes = boxes
    state.boxesLoadedDate = new Date()
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
  },
  [types.ADD_BOX_PICTURE] (state, internalid) {
    let idx = state.boxes.findIndex(intbox => intbox.internalid === internalid)
    state.boxes[idx].haspicture = 1
  }
}

const actions = {
  addBox (store, box) {
    store.commit(types.ADD_BOX, box)
  },
  editBox (store, box) {
    store.commit(types.EDIT_BOX, box)
  },
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
  },
  createBox (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('box', formData).then(response => {
        store.dispatch('addBox', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateBox (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('box/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editBox', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addBoxPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_BOX_PICTURE, internalid)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
