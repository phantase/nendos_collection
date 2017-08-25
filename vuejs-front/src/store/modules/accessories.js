import * as types from '../mutation-types.js'

const state = {
  accessories: [],
  accessoriesLoadedDate: null,
  accessoriesTagsCodeList: []
}

const getters = {
  accessories (state) {
    return state.accessories
  },
  countaccessories (state) {
    return state.accessories.length
  },
  countuseraccessories (state) {
    return state.accessories.filter(accessory => accessory.collquantity).length
  },
  accessoriesLoadedDate (state) {
    return state.accessoriesLoadedDate
  },
  accessoriesTypeCodeList (state) {
    return state.accessories.map(a => a.type).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  accessoriesMainColorCodeList (state) {
    return state.accessories.map(a => a.main_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  accessoriesOtherColorCodeList (state) {
    return state.accessories.map(a => a.other_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  accessoriesTagsCodeList (state) {
    return state.accessoriesTagsCodeList
  }
}

const mutations = {
  [types.ADD_ACCESSORY] (state, accessory) {
    state.accessories.push(accessory)
  },
  [types.EDIT_ACCESSORY] (state, accessory) {
    let idx = state.accessories.findIndex(intaccessory => intaccessory.internalid === accessory.internalid)
    state.accessories[idx] = accessory
  },
  [types.SET_ACCESSORIES] (state, accessories) {
    state.accessories = accessories
    state.accessoriesLoadedDate = new Date()
  },
  [types.COLLECT_ACCESSORY] (state, accessoryid) {
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].collquantity++
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_ACCESSORY] (state, accessoryid) {
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].collquantity--
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_ACCESSORY] (state, payload) {
    let accessoryid = payload.accessoryid
    let userid = payload.userid
    let username = payload.username
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validatorid = userid
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validatorname = username
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_ACCESSORY] (state, accessoryid) {
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validatorid = null
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validatorname = null
    state.accessories.filter(accessory => accessory.internalid === accessoryid)[0].validationdate = null
  },
  [types.FAVORITE_ACCESSORY] (state, accessoryid) {
    state.accessories.find(accessory => accessory.internalid === accessoryid).numberfavorited++
    state.accessories.find(accessory => accessory.internalid === accessoryid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_ACCESSORY] (state, accessoryid) {
    state.accessories.find(accessory => accessory.internalid === accessoryid).numberfavorited--
    state.accessories.find(accessory => accessory.internalid === accessoryid).inuserfavorites = null
  },
  [types.ADD_ACCESSORY_PICTURE] (state, internalid) {
    let idx = state.accessories.findIndex(intaccessory => intaccessory.internalid === internalid)
    state.accessories[idx].haspicture = 1
  },
  [types.SET_ACCESSORIES_TAGS_CODELIST] (state, tags) {
    state.accessoriesTagsCodeList = tags
  },
  [types.TAG_ACCESSORY] (state, payload) {
    let accessoryid = payload.accessoryid
    let tag = payload.tag
    if (state.accessories.find(accessory => accessory.internalid === accessoryid).tags) {
      state.accessories.find(accessory => accessory.internalid === accessoryid).tags.push({'tag': tag})
    } else {
      state.accessories.find(accessory => accessory.internalid === accessoryid).tags = [{'tag': tag}]
    }
  }
}

const actions = {
  addAccessory (store, accessory) {
    // store.dispatch('addAccessoryToIndex', accessory)
    store.commit(types.ADD_ACCESSORY, accessory)
  },
  editAccessory (store, accessory) {
    // store.dispatch('editAccessoryToIndex', accessory)
    store.commit(types.EDIT_ACCESSORY, accessory)
  },
  setAccessories (store, accessories) {
    // accessories.forEach((accessory) => {
    //   store.dispatch('addAccessoryToIndex', accessory)
    // })
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
  },
  validateAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/validate').then(response => {
        store.commit(types.VALIDATE_ACCESSORY, {
          'accessoryid': accessoryid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_ACCESSORY, accessoryid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  favoriteAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/favorite').then(response => {
        store.commit(types.FAVORITE_ACCESSORY, accessoryid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.patch('accessories/' + accessoryid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_ACCESSORY, accessoryid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createAccessory (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('accessory', formData).then(response => {
        store.dispatch('addAccessory', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateAccessory (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('accessory/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editAccessory', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addAccessoryPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_ACCESSORY_PICTURE, internalid)
  },
  setAccessoriesTagsCodeList (store, tags) {
    store.commit(types.SET_ACCESSORIES_TAGS_CODELIST, tags)
  },
  retrieveAccessoriesTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('accessories/tags', {
        before (request) {
          if (this.previousAccessoriesTagsCodeListRequest) {
            this.previousAccessoriesTagsCodeListRequest.abort()
          }
          this.previousAccessoriesTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setAccessoriesTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('accessories/' + accessoryid + '/tag', formData).then(response => {
        store.commit(types.TAG_ACCESSORY, payload)
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
