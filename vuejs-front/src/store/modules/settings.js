import * as types from '../mutation-types.js'

const state = {
  autoReload: false,
  reloadInterval: 1,
  intervalID: null,
  boxesOrderedBy: 'creationdate',
  boxesDirection: 'desc',
  nendoroidsOrderedBy: 'creationdate',
  nendoroidsDirection: 'desc',
  facesOrderedBy: 'creationdate',
  facesDirection: 'desc',
  hairsOrderedBy: 'creationdate',
  hairsDirection: 'desc',
  handsOrderedBy: 'creationdate',
  handsDirection: 'desc',
  bodypartsOrderedBy: 'creationdate',
  bodypartsDirection: 'desc',
  accessoriesOrderedBy: 'creationdate',
  accessoriesDirection: 'desc'
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
  },
  facesOrderedBy (state) {
    return state.facesOrderedBy
  },
  facesDirection (state) {
    return state.facesDirection
  },
  hairsOrderedBy (state) {
    return state.hairsOrderedBy
  },
  hairsDirection (state) {
    return state.hairsDirection
  },
  handsOrderedBy (state) {
    return state.handsOrderedBy
  },
  handsDirection (state) {
    return state.handsDirection
  },
  bodypartsOrderedBy (state) {
    return state.bodypartsOrderedBy
  },
  bodypartsDirection (state) {
    return state.bodypartsDirection
  },
  accessoriesOrderedBy (state) {
    return state.accessoriesOrderedBy
  },
  accessoriesDirection (state) {
    return state.accessoriesDirection
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
  },
  [types.SET_FACESORDEREDBY] (state, facesOrderedBy) {
    state.facesOrderedBy = facesOrderedBy
  },
  [types.SET_FACESDIRECTION] (state, facesDirection) {
    state.facesDirection = facesDirection
  },
  [types.SET_HAIRSORDEREDBY] (state, hairsOrderedBy) {
    state.hairsOrderedBy = hairsOrderedBy
  },
  [types.SET_HAIRSDIRECTION] (state, hairsDirection) {
    state.hairsDirection = hairsDirection
  },
  [types.SET_HANDSORDEREDBY] (state, handsOrderedBy) {
    state.handsOrderedBy = handsOrderedBy
  },
  [types.SET_HANDSDIRECTION] (state, handsDirection) {
    state.handsDirection = handsDirection
  },
  [types.SET_BODYPARTSORDEREDBY] (state, bodypartsOrderedBy) {
    state.bodypartsOrderedBy = bodypartsOrderedBy
  },
  [types.SET_BODYPARTSDIRECTION] (state, bodypartsDirection) {
    state.bodypartsDirection = bodypartsDirection
  },
  [types.SET_ACCESSORIESORDEREDBY] (state, accessoriesOrderedBy) {
    state.accessoriesOrderedBy = accessoriesOrderedBy
  },
  [types.SET_ACCESSORIESDIRECTION] (state, accessoriesDirection) {
    state.accessoriesDirection = accessoriesDirection
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
  },
  setFacesOrderedBy (store, facesOrderedBy) {
    store.commit(types.SET_FACESORDEREDBY, facesOrderedBy)
  },
  setFacesDirection (store, facesDirection) {
    store.commit(types.SET_FACESDIRECTION, facesDirection)
  },
  setHairsOrderedBy (store, hairsOrderedBy) {
    store.commit(types.SET_HAIRSORDEREDBY, hairsOrderedBy)
  },
  setHairsDirection (store, hairsDirection) {
    store.commit(types.SET_HAIRSDIRECTION, hairsDirection)
  },
  setHandsOrderedBy (store, handsOrderedBy) {
    store.commit(types.SET_HANDSORDEREDBY, handsOrderedBy)
  },
  setHandsDirection (store, handsDirection) {
    store.commit(types.SET_HANDSDIRECTION, handsDirection)
  },
  setBodypartsOrderedBy (store, bodypartsOrderedBy) {
    store.commit(types.SET_BODYPARTSORDEREDBY, bodypartsOrderedBy)
  },
  setBodypartsDirection (store, bodypartsDirection) {
    store.commit(types.SET_BODYPARTSDIRECTION, bodypartsDirection)
  },
  setAccessoriesOrderedBy (store, accessoriesOrderedBy) {
    store.commit(types.SET_ACCESSORIESORDEREDBY, accessoriesOrderedBy)
  },
  setAccessoriesDirection (store, accessoriesDirection) {
    store.commit(types.SET_ACCESSORIESDIRECTION, accessoriesDirection)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
