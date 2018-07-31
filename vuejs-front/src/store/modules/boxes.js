import * as types from '../mutation-types.js'

const state = {
  boxes: [],
  boxesLoadedDate: null,
  boxesLoadedPartially: false,
  boxesTagsCodeList: []
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
  },
  boxesLoadedPartially (state) {
    return state.boxesLoadedPartially
  },
  boxesSeriesCodeList (state) {
    return state.boxes.map(a => a.series).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  boxesCategoryCodeList (state) {
    return state.boxes.map(a => a.category).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  boxesManufacturerCodeList (state) {
    return state.boxes.map(a => a.manufacturer).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  boxesSculptorCodeList (state) {
    return state.boxes.map(a => a.sculptor).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  boxesCooperationCodeList (state) {
    return state.boxes.map(a => a.cooperation).filter((elem, pos, arr) => {
      return elem && arr.indexOf(elem) === pos
    }).sort()
  },
  boxesTagsCodeList (state) {
    return state.boxesTagsCodeList
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
  [types.FAVORITE_BOX] (state, boxid) {
    state.boxes.find(box => box.internalid === boxid).numberfavorited++
    state.boxes.find(box => box.internalid === boxid).inuserfavorites = '1'
  },
  [types.UNFAVORITE_BOX] (state, boxid) {
    state.boxes.find(box => box.internalid === boxid).numberfavorited--
    state.boxes.find(box => box.internalid === boxid).inuserfavorites = null
  },
  [types.ADD_BOX_PICTURE] (state, payload) {
    let internalid = payload.internalid
    let number = payload.number
    let idx = state.boxes.findIndex(intbox => intbox.internalid === internalid)
    if (number > state.boxes[idx].nbpictures) {
      state.boxes[idx].nbpictures ++
    }
  },
  [types.SET_BOXES_TAGS_CODELIST] (state, tags) {
    state.boxesTagsCodeList = tags
  },
  [types.TAG_BOX] (state, payload) {
    let boxid = payload.boxid
    let tag = payload.tag
    console.log(boxid)
    console.log(tag)
    if (state.boxes.find(box => box.internalid === boxid).tags) {
      state.boxes.find(box => box.internalid === boxid).tags.push({'tag': tag})
    } else {
      state.boxes.find(box => box.internalid === boxid).tags = [{'tag': tag}]
    }
  },
  [types.SET_BOXES_PARTIAL] (state, isPartial) {
    state.boxesLoadedPartially = isPartial
  }
}

const actions = {
  addBox (store, box) {
    // store.dispatch('addBoxToIndex', box)
    store.commit(types.ADD_BOX, box)
  },
  editBox (store, box) {
    // store.dispatch('editBoxToIndex', box)
    store.commit(types.EDIT_BOX, box)
  },
  setBoxes (store, boxes) {
    // boxes.forEach((box) => {
    //   store.dispatch('addBoxToIndex', box)
    // })
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
        store.commit(types.SET_BOXES_PARTIAL, false)
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
  favoriteBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/favorite').then(response => {
        store.commit(types.FAVORITE_BOX, boxid)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  unfavoriteBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.patch('boxes/' + boxid + '/unfavorite').then(response => {
        store.commit(types.UNFAVORITE_BOX, boxid)
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
    let number = payload.number
    store.commit(types.ADD_BOX_PICTURE, {
      'internalid': internalid,
      'number': number
    })
  },
  setBoxesTagsCodeList (store, tags) {
    store.commit(types.SET_BOXES_TAGS_CODELIST, tags)
  },
  retrieveBoxesTagsCodeList (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('boxes/tags', {
        before (request) {
          if (this.previousBoxesTagsCodeListRequest) {
            this.previousBoxesTagsCodeListRequest.abort()
          }
          this.previousBoxesTagsCodeListRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxesTagsCodeList', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  tagBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    let tag = payload.tag
    return new Promise((resolve, reject) => {
      let formData = new FormData()
      formData.append('tag', tag)
      context.$http.post('boxes/' + boxid + '/tag', formData).then(response => {
        store.commit(types.TAG_BOX, payload)
        resolve()
      }, response => {
        reject()
      })
    })
  },
  retrieveSingleBox (store, payload) {
    let context = payload.context
    let boxid = payload.boxid
    return new Promise((resolve, reject) => {
      context.$http.get('box/' + boxid, {
        before (request) {
          if (this.previousSingleBoxRequest) {
            this.previousSingleBoxRequest.abort()
          }
          this.previousSingleBoxRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', [response.data])
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForNendoroid (store, payload) {
    let context = payload.context
    let nendoroidid = payload.nendoroidid
    return new Promise((resolve, reject) => {
      context.$http.get('nendoroid/' + nendoroidid + '/boxes', {
        before (request) {
          if (this.previousBoxesForNendoroidRequest) {
            this.previousBoxesForNendoroidRequest.abort()
          }
          this.previousBoxesForNendoroidRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForAccessory (store, payload) {
    let context = payload.context
    let accessoryid = payload.accessoryid
    return new Promise((resolve, reject) => {
      context.$http.get('accessory/' + accessoryid + '/boxes', {
        before (request) {
          if (this.previousBoxesForAccessoryRequest) {
            this.previousBoxesForAccessoryRequest.abort()
          }
          this.previousBoxesForAccessoryRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForBodypart (store, payload) {
    let context = payload.context
    let bodypartid = payload.bodypartid
    return new Promise((resolve, reject) => {
      context.$http.get('bodypart/' + bodypartid + '/boxes', {
        before (request) {
          if (this.previousBoxesForBodypartRequest) {
            this.previousBoxesForBodypartRequest.abort()
          }
          this.previousBoxesForBodypartRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForFace (store, payload) {
    let context = payload.context
    let faceid = payload.faceid
    return new Promise((resolve, reject) => {
      context.$http.get('face/' + faceid + '/boxes', {
        before (request) {
          if (this.previousBoxesForFaceRequest) {
            this.previousBoxesForFaceRequest.abort()
          }
          this.previousBoxesForFaceRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForHair (store, payload) {
    let context = payload.context
    let hairid = payload.hairid
    return new Promise((resolve, reject) => {
      context.$http.get('hair/' + hairid + '/boxes', {
        before (request) {
          if (this.previousBoxesForHairRequest) {
            this.previousBoxesForHairRequest.abort()
          }
          this.previousBoxesForHairRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  retrieveBoxesForHand (store, payload) {
    let context = payload.context
    let handid = payload.handid
    return new Promise((resolve, reject) => {
      context.$http.get('hand/' + handid + '/boxes', {
        before (request) {
          if (this.previousBoxesForHandRequest) {
            this.previousBoxesForHandRequest.abort()
          }
          this.previousBoxesForHandRequest = request
        }
      }).then((response) => {
        store.dispatch('setBoxes', response.data)
        store.commit(types.SET_BOXES_PARTIAL, true)
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
