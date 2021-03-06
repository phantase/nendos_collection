import * as types from '../mutation-types.js'

const state = {
  nendoroids: [],
  nendoroidsLoadedDate: null,
  nendoroidsLoadedPartially: false,
  nendoroidsTagsCodeList: []
}

const getters = {
  nendoroids (state) {
    return state.nendoroids
  },
  countnendoroids (state) {
    return state.nendoroids.length
  },
  countusernendoroids (state) {
    return state.nendoroids.filter(nendoroid => nendoroid.collquantity).length
  },
  nendoroidsLoadedDate (state) {
    return state.nendoroidsLoadedDate
  },
  nendoroidsLoadedPartially (state) {
    return state.nendoroidsLoadedPartially
  },
  nendoroidsNameCodeList (state) {
    return state.nendoroids.map(a => a.name).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  nendoroidsVersionCodeList (state) {
    return state.nendoroids.map(a => a.version).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  nendoroidsSexCodeList (state) {
    return state.nendoroids.map(a => a.sex).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  nendoroidsTagsCodeList (state) {
    return state.nendoroidsTagsCodeList
  }
}

const mutations = {
  [types.ADD_NENDOROID] (state, nendoroid) {
    state.nendoroids.push(nendoroid)
  },
  [types.EDIT_NENDOROID] (state, nendoroid) {
    let idx = state.nendoroids.findIndex(intnendoroid => intnendoroid.internalid === nendoroid.internalid)
    state.nendoroids[idx] = nendoroid
  },
  [types.SET_NENDOROIDS] (state, nendoroids) {
    state.nendoroids = nendoroids
    state.nendoroidsLoadedDate = new Date()
  },
  [types.COLLECT_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].collquantity++
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].colladdeddate = 'NOW'
  },
  [types.UNCOLLECT_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].collquantity--
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].colladdeddate = 'NOW'
  },
  [types.VALIDATE_NENDOROID] (state, payload) {
    let nendoroidid = payload.nendoroidid
    let userid = payload.userid
    let username = payload.username
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorid = userid
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorname = username
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validationdate = 'NOW'
  },
  [types.UNVALIDATE_NENDOROID] (state, nendoroidid) {
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorid = null
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validatorname = null
    state.nendoroids.filter(nendoroid => nendoroid.internalid === nendoroidid)[0].validationdate = null
  },
  [types.FAVORITE_NENDOROID] (state, nendoroidid) {
    state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).numberfavorited++
    state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_NENDOROID] (state, nendoroidid) {
    state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).numberfavorited--
    state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).inuserfavorites = null
  },
  [types.ADD_NENDOROID_PICTURE] (state, payload) {
    let internalid = payload.internalid
    let number = payload.number
    let idx = state.nendoroids.findIndex(intnendoroid => intnendoroid.internalid === internalid)
    if (number > state.nendoroids[idx].nbpictures) {
      state.nendoroids[idx].nbpictures ++
    }
  },
  [types.SET_NENDOROIDS_TAGS_CODELIST] (state, tags) {
    state.nendoroidsTagsCodeList = tags
  },
  [types.TAG_NENDOROID] (state, payload) {
    let nendoroidid = payload.nendoroidid
    let tag = payload.tag
    console.log(nendoroidid)
    console.log(tag)
    if (state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).tags) {
      state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).tags.push({'tag': tag})
    } else {
      state.nendoroids.find(nendoroid => nendoroid.internalid === nendoroidid).tags = [{'tag': tag}]
    }
  },
  [types.SET_NENDOROIDS_PARTIAL] (state, isPartial) {
    state.nendoroidsLoadedPartially = isPartial
  }
}

const actions = {
  addNendoroid (store, nendoroid) {
    // store.dispatch('addNendoroidToIndex', nendoroid)
    store.commit(types.ADD_NENDOROID, nendoroid)
  },
  editNendoroid (store, nendoroid) {
    // store.dispatch('editNendoroidToIndex', nendoroid)
    store.commit(types.EDIT_NENDOROID, nendoroid)
  },
  setNendoroids (store, nendoroids) {
    // nendoroids.forEach((nendoroid) => {
    //   store.dispatch('addNendoroidToIndex', nendoroid)
    // })
    store.commit(types.SET_NENDOROIDS, nendoroids)
  },
  retrieveNendoroids (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroids', {
        before (request) {
          if (this.previousNendoroidsRequest) {
            this.previousNendoroidsRequest.abort()
          }
          this.previousNendoroidsRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, false)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  collectNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/collect').then(response => {
        store.commit(types.COLLECT_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  uncollectNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/uncollect').then(response => {
        store.commit(types.UNCOLLECT_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  validateNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/validate').then(response => {
        store.commit(types.VALIDATE_NENDOROID, {
          'nendoroidid': nendoroidid,
          'userid': store.rootState.auth.user.internalid,
          'username': store.rootState.auth.user.username
        })
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unvalidateNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/unvalidate').then(response => {
        store.commit(types.UNVALIDATE_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  favoriteNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/favorite').then(response => {
        store.commit(types.FAVORITE_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.patch('nendoroids/' + nendoroidid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_NENDOROID, nendoroidid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  createNendoroid (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('nendoroid', formData).then(response => {
        store.dispatch('addNendoroid', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateNendoroid (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('nendoroid/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editNendoroid', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addNendoroidPicture (store, payload) {
    let internalid = payload.internalid
    let number = payload.number
    store.commit(types.ADD_NENDOROID_PICTURE, {
      'internalid': internalid,
      'number': number
    })
  },
  setNendoroidsTagsCodeList (store, tags) {
    store.commit(types.SET_NENDOROIDS_TAGS_CODELIST, tags)
  },
  retrieveNendoroidsTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroids/tags', {
        before (request) {
          if (this.previousNendoroidsTagsCodeListRequest) {
            this.previousNendoroidsTagsCodeListRequest.abort()
          }
          this.previousNendoroidsTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroidsTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('nendoroids/' + nendoroidid + '/tag', formData).then(response => {
        store.commit(types.TAG_NENDOROID, payload)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  retrieveSingleNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroid/' + nendoroidid, {
        before (request) {
          if (this.previousSingleNendoroidRequest) {
            this.previousSingleNendoroidRequest.abort()
          }
          this.previousSingleNendoroidRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', [response.data])
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.get('box/' + boxid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForBoxRequest) {
            this.previousNendoroidsForBoxRequest.abort()
          }
          this.previousNendoroidsForBoxRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.get('accessory/' + accessoryid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForAccessoryRequest) {
            this.previousNendoroidsForAccessoryRequest.abort()
          }
          this.previousNendoroidsForAccessoryRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.get('bodypart/' + bodypartid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForBodypartRequest) {
            this.previousNendoroidsForBodypartRequest.abort()
          }
          this.previousNendoroidsForBodypartRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.get('face/' + faceid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForFaceRequest) {
            this.previousNendoroidsForFaceRequest.abort()
          }
          this.previousNendoroidsForFaceRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.get('hair/' + hairid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForHairRequest) {
            this.previousNendoroidsForHairRequest.abort()
          }
          this.previousNendoroidsForHairRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveNendoroidsForHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.get('hand/' + handid + '/nendoroids', {
        before (request) {
          if (this.previousNendoroidsForHandRequest) {
            this.previousNendoroidsForHandRequest.abort()
          }
          this.previousNendoroidsForHandRequest = request
        }
      }).then((response) => {
        store.dispatch('setNendoroids', response.data)
        store.commit(types.SET_NENDOROIDS_PARTIAL, true)
        resolve()
      }, (response) => {
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
