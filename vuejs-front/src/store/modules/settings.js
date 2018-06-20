import * as types from '../mutation-types.js'

const state = {
  autoReload: false,
  reloadInterval: 1,
  intervalID: null,
  boxesOrderedBy: 'creationdate',
  boxesDirection: 'desc',
  nendoroidsOrderedBy: 'creationdate',
  nendoroidsDirection: 'desc'
}

const getters = {
  autoReload (state) {
    return state.autoReload
  },
  reloadInterval (state) {
    return state.reloadInterval
  },
  intervalID (state) {
    return state.intervalID
  },
  boxesOrderedBy (state) {
    return state.boxesOrderedBy
  },
  boxesDirection (state) {
    return state.boxesDirection
  },
  nendoroidsOrderedBy (state) {
    return state.nendoroidsOrderedBy
  },
  nendoroidsDirection (state) {
    return state.nendoroidsDirection
  }
}

const mutations = {
  [types.SET_AUTORELOAD] (state, autoReload) {
    state.autoReload = autoReload
  },
  [types.SET_RELOADINTERVAL] (state, reloadInterval) {
    state.reloadInterval = reloadInterval
  },
  [types.SET_INTERVALID] (state, intervalID) {
    state.intervalID = intervalID
  },
  [types.SET_BOXESORDEREDBY] (state, boxesOrderedBy) {
    state.boxesOrderedBy = boxesOrderedBy
  },
  [types.SET_BOXESDIRECTION] (state, boxesDirection) {
    state.boxesDirection = boxesDirection
  },
  [types.SET_NENDOROIDSORDEREDBY] (state, nendoroidsOrderedBy) {
    state.nendoroidsOrderedBy = nendoroidsOrderedBy
  },
  [types.SET_NENDOROIDSDIRECTION] (state, nendoroidsDirection) {
    state.nendoroidsDirection = nendoroidsDirection
  }
}

const actions = {
  setAutoReload (store, payload) {
    let autoReload = payload.value
    store.commit(types.SET_AUTORELOAD, autoReload)
    if (autoReload) {
      console.log('launch AutoReload')
      store.dispatch('setIntervalID',
        window.setInterval(() => {
          store.dispatch('retrieveData', payload)
        }, store.state.reloadInterval * 60 * 1000))
    } else {
      console.log('stop AutoReload')
      window.clearInterval(store.state.intervalID)
    }
  },
  setReloadInterval (store, payload) {
    let reloadInterval = payload.value
    store.commit(types.SET_RELOADINTERVAL, reloadInterval)
    if (store.state.autoReload) {
      console.log('stop AutoReload')
      window.clearInterval(store.state.intervalID)
      console.log('launch a new AutoReload')
      store.dispatch('setIntervalID',
        window.setInterval(() => {
          store.dispatch('retrieveData', payload)
        }, store.state.reloadInterval * 60 * 1000))
    }
  },
  setIntervalID (store, intervalID) {
    store.commit(types.SET_INTERVALID, intervalID)
  },
  setBoxesOrderedBy (store, boxesOrderedBy) {
    store.commit(types.SET_BOXESORDEREDBY, boxesOrderedBy)
  },
  setBoxesDirection (store, boxesDirection) {
    store.commit(types.SET_BOXESDIRECTION, boxesDirection)
  },
  setNendoroidsOrderedBy (store, nendoroidsOrderedBy) {
    store.commit(types.SET_NENDOROIDSORDEREDBY, nendoroidsOrderedBy)
  },
  setNendoroidsDirection (store, nendoroidsDirection) {
    store.commit(types.SET_NENDOROIDSDIRECTION, nendoroidsDirection)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
