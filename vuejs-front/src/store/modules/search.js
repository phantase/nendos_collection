import * as types from '../mutation-types.js'

const state = {
  searchTerm: null
}

const getters = {
  searchTerm (state) {
    return state.searchTerm
  }
}

const mutations = {
  [types.INIT_SEARCH] (state) {
    // console.log('INIT_SEARCH (do nothing)')
  },
  [types.ADD_BOX_TO_INDEX] (state, box) {
    // console.log('ADD_BOX_TO_INDEX (do nothing)')
  },
  [types.ADD_NENDOROID_TO_INDEX] (state, nendoroid) {
    // console.log('ADD_NENDOROID_TO_INDEX (do nothing)')
  },
  [types.ADD_ACCESSORY_TO_INDEX] (state, accessory) {
    // console.log('ADD_ACCESSORY_TO_INDEX (do nothing)')
  },
  [types.ADD_BODYPART_TO_INDEX] (state, bodypart) {
    // console.log('ADD_BODYPART_TO_INDEX (do nothing)')
  },
  [types.ADD_FACE_TO_INDEX] (state, face) {
    // console.log('ADD_FACE_TO_INDEX (do nothing)')
  },
  [types.ADD_HAIR_TO_INDEX] (state, hair) {
    // console.log('ADD_HAIR_TO_INDEX (do nothing)')
  },
  [types.ADD_HAND_TO_INDEX] (state, hand) {
    // console.log('ADD_HAND_TO_INDEX (do nothing)')
  },
  [types.ADD_PHOTO_TO_INDEX] (state, photo) {
    // console.log('ADD_PHOTO_TO_INDEX (do nothing)')
  },
  [types.EDIT_BOX_IN_INDEX] (state, box) {
    // console.log('EDIT_BOX_IN_INDEX (do nothing)')
  },
  [types.EDIT_NENDOROID_IN_INDEX] (state, nendoroid) {
    // console.log('EDIT_NENDOROID_IN_INDEX (do nothing)')
  },
  [types.EDIT_ACCESSORY_IN_INDEX] (state, accessory) {
    // console.log('EDIT_ACCESSORY_IN_INDEX (do nothing)')
  },
  [types.EDIT_BODYPART_IN_INDEX] (state, bodypart) {
    // console.log('EDIT_BODYPART_IN_INDEX (do nothing)')
  },
  [types.EDIT_FACE_IN_INDEX] (state, face) {
    // console.log('EDIT_FACE_IN_INDEX (do nothing)')
  },
  [types.EDIT_HAIR_IN_INDEX] (state, hair) {
    // console.log('EDIT_HAIR_IN_INDEX (do nothing)')
  },
  [types.EDIT_HAND_IN_INDEX] (state, hand) {
    // console.log('EDIT_HAND_IN_INDEX (do nothing)')
  },
  [types.EDIT_PHOTO_IN_INDEX] (state, photo) {
    // console.log('EDIT_PHOTO_IN_INDEX (do nothing)')
  },
  [types.SET_A_SEARCH_TERM] (state, term) {
    state.searchTerm = term
  },
  [types.RESET_A_SEARCH_TERM] (state) {
    state.searchTerm = null
  }
}

const actions = {
  initSearch (store) {
    store.commit(types.INIT_SEARCH)
  },
  addBoxToIndex (store, box) {
    store.commit(types.ADD_BOX_TO_INDEX, box)
  },
  addNendoroidToIndex (store, nendoroid) {
    store.commit(types.ADD_NENDOROID_TO_INDEX, nendoroid)
  },
  addAccessoryToIndex (store, accessory) {
    store.commit(types.ADD_ACCESSORY_TO_INDEX, accessory)
  },
  addBodypartToIndex (store, bodypart) {
    store.commit(types.ADD_BODYPART_TO_INDEX, bodypart)
  },
  addFaceToIndex (store, face) {
    store.commit(types.ADD_FACE_TO_INDEX, face)
  },
  addHairToIndex (store, hair) {
    store.commit(types.ADD_HAIR_TO_INDEX, hair)
  },
  addHandToIndex (store, hand) {
    store.commit(types.ADD_HAND_TO_INDEX, hand)
  },
  addPhotoToIndex (store, photo) {
    store.commit(types.ADD_PHOTO_TO_INDEX, photo)
  },
  editBoxInIndex (store, box) {
    store.commit(types.EDIT_BOX_IN_INDEX, box)
  },
  editNendoroidInIndex (store, nendoroid) {
    store.commit(types.EDIT_NENDOROID_IN_INDEX, nendoroid)
  },
  editAccessoryInIndex (store, accessory) {
    store.commit(types.EDIT_ACCESSORY_IN_INDEX, accessory)
  },
  editBodypartInIndex (store, bodypart) {
    store.commit(types.EDIT_BODYPART_IN_INDEX, bodypart)
  },
  editFaceInIndex (store, face) {
    store.commit(types.EDIT_FACE_IN_INDEX, face)
  },
  editHairInIndex (store, hair) {
    store.commit(types.EDIT_HAIR_IN_INDEX, hair)
  },
  editHandInIndex (store, hand) {
    store.commit(types.EDIT_HAND_IN_INDEX, hand)
  },
  editPhotoInIndex (store, photo) {
    store.commit(types.EDIT_PHOTO_IN_INDEX, photo)
  },
  doSearch ({commit, getters}, payload) {
    let foundboxes = []
    getters.boxes.filter((box) => {
      if (box.name && box.name.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (box.series && box.series.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (box.sculptor && box.sculptor.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (box.cooperation && box.cooperation.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((box) => {
      foundboxes.push({'ref': box.internalid})
    })
    let foundnendoroids = []
    getters.nendoroids.filter((nendoroid) => {
      if (nendoroid.name && nendoroid.name.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (nendoroid.version && nendoroid.version.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (nendoroid.sex && nendoroid.sex.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((nendoroid) => {
      foundnendoroids.push({'ref': nendoroid.internalid})
    })
    let foundaccessories = []
    getters.accessories.filter((accessory) => {
      if (accessory.type && accessory.type.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (accessory.description && accessory.description.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (accessory.main_color && accessory.main_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (accessory.other_color && accessory.other_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((accessory) => {
      foundaccessories.push({'ref': accessory.internalid})
    })
    let foundbodyparts = []
    getters.bodyparts.filter((bodypart) => {
      if (bodypart.part && bodypart.part.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (bodypart.description && bodypart.description.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (bodypart.main_color && bodypart.main_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (bodypart.other_color && bodypart.other_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((bodypart) => {
      foundbodyparts.push({'ref': bodypart.internalid})
    })
    let foundfaces = []
    getters.faces.filter((face) => {
      if (face.eyes && face.eyes.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (face.mouth && face.mouth.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (face.eyes_color && face.eyes_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (face.skin_color && face.skin_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (face.sex && face.sex.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((face) => {
      foundfaces.push({'ref': face.internalid})
    })
    let foundhairs = []
    getters.hairs.filter((hair) => {
      if (hair.haircut && hair.haircut.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hair.description && hair.description.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hair.main_color && hair.main_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hair.other_color && hair.other_color.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hair.frontback && hair.frontback.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((hair) => {
      foundhairs.push({'ref': hair.internalid})
    })
    let foundhands = []
    getters.hands.filter((hand) => {
      if (hand.posture && hand.posture.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hand.leftright && hand.leftright.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      } else if (hand.description && hand.description.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((hand) => {
      foundhands.push({'ref': hand.internalid})
    })
    let foundphotos = []
    getters.photos.filter((photo) => {
      if (photo.title && photo.title.toLowerCase().indexOf(payload.queryTerm) !== -1) {
        return true
      }
      return false
    }).forEach((photo) => {
      foundphotos.push({'ref': photo.internalid})
    })
    return {
      'boxes': foundboxes,
      'nendoroids': foundnendoroids,
      'accessories': foundaccessories,
      'bodyparts': foundbodyparts,
      'faces': foundfaces,
      'hairs': foundhairs,
      'hands': foundhands,
      'photos': foundphotos
    }
  },
  setSearchTerm (store, term) {
    store.commit(types.SET_A_SEARCH_TERM, term)
  },
  resetSearchTerm (store) {
    store.commit(types.RESET_A_SEARCH_TERM)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
