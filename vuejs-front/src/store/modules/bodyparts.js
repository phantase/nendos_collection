import * as types from '../mutation-types.js'

const state = {
  bodyparts: [],
  bodypartsLoadedDate: null,
  bodypartsLoadedPartially: false,
  bodypartsTagsCodeList: []
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
  },
  bodypartsLoadedDate (state) {
    return state.bodypartsLoadedDate
  },
  bodypartsLoadedPartially (state) {
    return state.bodypartsLoadedPartially
  },
  bodypartsPartCodeList (state) {
    return state.bodyparts.map(a => a.part).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  bodypartsMainColorCodeList (state) {
    return state.bodyparts.map(a => a.main_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  bodypartsOtherColorCodeList (state) {
    return state.bodyparts.map(a => a.other_color).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  bodypartsTagsCodeList (state) {
    return state.bodypartsTagsCodeList
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
    state.bodypartsLoadedDate = new Date()
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
  [types.FAVORITE_BODYPART] (state, bodypartid) {
    state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).numberfavorited++
    state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_BODYPART] (state, bodypartid) {
    state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).numberfavorited--
    state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).inuserfavorites = null
  },
  [types.ADD_BODYPART_PICTURE] (state, payload) {
    let internalid = payload.internalid
    let number = payload.number
    let idx = state.bodyparts.findIndex(intbodypart => intbodypart.internalid === internalid)
    if (number > state.bodyparts[idx].nbpictures) {
      state.bodyparts[idx].nbpictures ++
    }
  },
  [types.SET_BODYPARTS_TAGS_CODELIST] (state, tags) {
    state.bodypartsTagsCodeList = tags
  },
  [types.TAG_BODYPART] (state, payload) {
    let bodypartid = payload.bodypartid
    let tag = payload.tag
    console.log(bodypartid)
    console.log(tag)
    if (state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).tags) {
      state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).tags.push({'tag': tag})
    } else {
      state.bodyparts.find(bodypart => bodypart.internalid === bodypartid).tags = [{'tag': tag}]
    }
  },
  [types.SET_BODYPARTS_PARTIAL] (state, isPartial) {
    state.bodypartsLoadedPartially = isPartial
  }
}

const actions = {
  addBodypart (store, bodypart) {
    // store.dispatch('addBodypartToIndex', bodypart)
    store.commit(types.ADD_BODYPART, bodypart)
  },
  editBodypart (store, bodypart) {
    // store.dispatch('editBodypartToIndex', bodypart)
    store.commit(types.EDIT_BODYPART, bodypart)
  },
  setBodyparts (store, bodyparts) {
    // bodyparts.forEach((bodypart) => {
    //   store.dispatch('addBodypartToIndex', bodypart)
    // })
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
        store.commit(types.SET_BODYPARTS_PARTIAL, false)
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
  favoriteBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/favorite').then(response => {
        store.commit(types.FAVORITE_BODYPART, bodypartid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.patch('bodyparts/' + bodypartid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_BODYPART, bodypartid)
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
    let number = payload.number
    store.commit(types.ADD_BODYPART_PICTURE, {
      'internalid': internalid,
      'number': number
    })
  },
  setBodypartsTagsCodeList (store, tags) {
    store.commit(types.SET_BODYPARTS_TAGS_CODELIST, tags)
  },
  retrieveBodypartsTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('bodyparts/tags', {
        before (request) {
          if (this.previousBodypartsTagsCodeListRequest) {
            this.previousBodypartsTagsCodeListRequest.abort()
          }
          this.previousBodypartsTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodypartsTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('bodyparts/' + bodypartid + '/tag', formData).then(response => {
        store.commit(types.TAG_BODYPART, payload)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  retrieveSingleBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.get('bodypart/' + bodypartid, {
        before (request) {
          if (this.previousSingleBodypartRequest) {
            this.previousSingleBodypartRequest.abort()
          }
          this.previousSingleBodypartRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodyparts', [response.data])
        store.commit(types.SET_BODYPARTS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBodypartsForBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.get('box/' + boxid + '/bodyparts', {
        before (request) {
          if (this.previousBodypartsForBoxRequest) {
            this.previousBodypartsForBoxRequest.abort()
          }
          this.previousBodypartsForBoxRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodyparts', response.data)
        store.commit(types.SET_BODYPARTS_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBodypartsForNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroid/' + nendoroidid + '/bodyparts', {
        before (request) {
          if (this.previousBodypartsForNendoroidRequest) {
            this.previousBodypartsForNendoroidRequest.abort()
          }
          this.previousBodypartsForNendoroidRequest = request
        }
      }).then((response) => {
        store.dispatch('setBodyparts', response.data)
        store.commit(types.SET_BODYPARTS_PARTIAL, true)
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
