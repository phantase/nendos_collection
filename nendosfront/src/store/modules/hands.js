import * as types from '../mutation-types.js'

const state = {
  hands: []
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
  }
}

const mutations = {
  [types.ADD_HAND] (state, hand) {
    state.hands.push(hand)
  },
  [types.SET_HANDS] (state, hands) {
    state.hands = hands
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
  }
}

const actions = {
  addHand (store, hand) {
    store.commit(types.ADD_HAND, hand)
  },
  setHands (store, hands) {
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
  createHand (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('hand/new', formData).then(response => {
        store.dispatch('addHand', response.data)
        resolve(response.data.internalid)
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
