import * as types from '../mutation-types.js'

const state = {
  hands: [],
  handsLoadedDate: null
}

const getters = {
  hands (state) {
    return state.hands
  },
  counthands (state) {
    return state.hands.length
  },
  countuserhands (state) {
    return state.hands.filter(hand => hand.collquantity).length
  },
  handsLoadedDate (state) {
    return state.handsLoadedDate
  },
  handsPostureCodeList (state) {
    return state.hands.map(a => a.posture).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  handsLeftRightCodeList (state) {
    return state.hands.map(a => a.leftright).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  handsSkinColorCodeList (state) {
    return state.hands.map(a => a.skin_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  }
}

const mutations = {
  [types.ADD_HAND] (state, hand) {
    state.hands.push(hand)
  },
  [types.EDIT_HAND] (state, hand) {
    let idx = state.hands.findIndex(inthand => inthand.internalid === hand.internalid)
    state.hands[idx] = hand
  },
  [types.SET_HANDS] (state, hands) {
    state.hands = hands
    state.handsLoadedDate = new Date()
  },
  [types.COLLECT_HAND] (state, handid) {
    state.hands.filter(hand => hand.internalid === handid)[0].collquantity++
    state.hands.filter(hand => hand.internalid === handid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_HAND] (state, handid) {
    state.hands.filter(hand => hand.internalid === handid)[0].collquantity--
    state.hands.filter(hand => hand.internalid === handid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_HAND] (state, payload) {
    let handid = payload.handid
    let userid = payload.userid
    let username = payload.username
    state.hands.filter(hand => hand.internalid === handid)[0].validatorid = userid
    state.hands.filter(hand => hand.internalid === handid)[0].validatorname = username
    state.hands.filter(hand => hand.internalid === handid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_HAND] (state, handid) {
    state.hands.filter(hand => hand.internalid === handid)[0].validatorid = null
    state.hands.filter(hand => hand.internalid === handid)[0].validatorname = null
    state.hands.filter(hand => hand.internalid === handid)[0].validationdate = null
  },
  [types.FAVORITE_HAND] (state, handid) {
    state.hands.find(hand => hand.internalid === handid).numberfavorited++
    state.hands.find(hand => hand.internalid === handid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_HAND] (state, handid) {
    state.hands.find(hand => hand.internalid === handid).numberfavorited--
    state.hands.find(hand => hand.internalid === handid).inuserfavorites = null
  },
  [types.ADD_HAND_PICTURE] (state, internalid) {
    let idx = state.hands.findIndex(inthand => inthand.internalid === internalid)
    state.hands[idx].haspicture = 1
  }
}

const actions = {
  addHand (store, hand) {
    // store.dispatch('addHandToIndex', hand)
    store.commit(types.ADD_HAND, hand)
  },
  editHand (store, hand) {
    // store.dispatch('editHandToIndex', hand)
    store.commit(types.EDIT_HAND, hand)
  },
  setHands (store, hands) {
    // hands.forEach((hand) => {
    //   store.dispatch('addHandToIndex', hand)
    // })
    store.commit(types.SET_HANDS, hands)
  },
  retrieveHands (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('hands', {
        before (request) {
          if (this.previousHandsRequest) {
            this.previousHandsRequest.abort()
          }
          this.previousHandsRequest = request
        }
      }).then((response) => {
        store.dispatch('setHands', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/collect').then(response => {
        store.commit(types.COLLECT_HAND, handid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_HAND, handid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  validateHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/validate').then(response => {
        store.commit(types.VALIDATE_HAND, {
          'handid': handid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_HAND, handid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  favoriteHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/favorite').then(response => {
        store.commit(types.FAVORITE_HAND, handid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.patch('hands/' + handid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_HAND, handid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createHand (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('hand', formData).then(response => {
        store.dispatch('addHand', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateHand (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('hand/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editHand', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addHandPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_HAND_PICTURE, internalid)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
