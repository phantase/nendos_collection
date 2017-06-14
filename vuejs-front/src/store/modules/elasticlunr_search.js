import * as types from '../mutation-types.js'

const state = {
  elasticlunr: require('elasticlunr'),
  boxesIndex: null,
  nendoroidsIndex: null,
  accessoriesIndex: null,
  bodypartsIndex: null,
  facesIndex: null,
  hairsIndex: null,
  handsIndex: null,
  photosIndex: null,
  searchTerm: null
}

const getters = {
  boxesIndex (state) {
    return state.boxesIndex
  },
  nendoroidsIndex (state) {
    return state.nendoroidsIndex
  },
  accessoriesIndex (state) {
    return state.accessoriesIndex
  },
  bodypartsIndex (state) {
    return state.bodypartsIndex
  },
  facesIndex (state) {
    return state.facesIndex
  },
  hairsIndex (state) {
    return state.hairsIndex
  },
  handsIndex (state) {
    return state.handsIndex
  },
  photosIndex (state) {
    return state.photosIndex
  },
  searchTerm (state) {
    return state.searchTerm
  }
}

const mutations = {
  [types.INIT_SEARCH] (state) {
    console.log('INIT_SEARCH')
    state.boxesIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('name')
      this.addField('series')
      this.addField('sculptor')
      this.addField('cooperation')
      this.saveDocument(false)
    })
    state.nendoroidsIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('name')
      this.addField('version')
      this.addField('sex')
      this.saveDocument(false)
    })
    state.accessoriesIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('type')
      this.addField('description')
      this.addField('main_color')
      this.addField('other_color')
      this.saveDocument(false)
    })
    state.bodypartsIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('part')
      this.addField('description')
      this.addField('main_color')
      this.addField('other_color')
      this.saveDocument(false)
    })
    state.facesIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('eyes')
      this.addField('mouth')
      this.addField('eyes_color')
      this.addField('skin_color')
      this.addField('sex')
      this.saveDocument(false)
    })
    state.hairsIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('haircut')
      this.addField('description')
      this.addField('main_color')
      this.addField('other_color')
      this.addField('frontback')
      this.saveDocument(false)
    })
    state.handsIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('posture')
      this.addField('leftright')
      this.addField('description')
      this.saveDocument(false)
    })
    state.photosIndex = state.elasticlunr(function () {
      this.setRef('internalid')
      this.addField('title')
      this.saveDocument(false)
    })
  },
  [types.ADD_BOX_TO_INDEX] (state, box) {
    console.log('ADD_BOX_TO_INDEX')
    state.boxesIndex.addDoc(box)
  },
  [types.ADD_NENDOROID_TO_INDEX] (state, nendoroid) {
    console.log('ADD_NENDOROID_TO_INDEX')
    state.nendoroidsIndex.addDoc(nendoroid)
  },
  [types.ADD_ACCESSORY_TO_INDEX] (state, accessory) {
    console.log('ADD_ACCESSORY_TO_INDEX')
    state.accessoriesIndex.addDoc(accessory)
  },
  [types.ADD_BODYPART_TO_INDEX] (state, bodypart) {
    console.log('ADD_BODYPART_TO_INDEX')
    state.bodypartsIndex.addDoc(bodypart)
  },
  [types.ADD_FACE_TO_INDEX] (state, face) {
    console.log('ADD_FACE_TO_INDEX')
    state.facesIndex.addDoc(face)
  },
  [types.ADD_HAIR_TO_INDEX] (state, hair) {
    console.log('ADD_HAIR_TO_INDEX')
    state.hairsIndex.addDoc(hair)
  },
  [types.ADD_HAND_TO_INDEX] (state, hand) {
    console.log('ADD_HAND_TO_INDEX')
    state.handsIndex.addDoc(hand)
  },
  [types.ADD_PHOTO_TO_INDEX] (state, photo) {
    console.log('ADD_PHOTO_TO_INDEX')
    state.photosIndex.addDoc(photo)
  },
  [types.EDIT_BOX_IN_INDEX] (state, box) {
    console.log('EDIT_BOX_IN_INDEX')
    state.boxesIndex.update(box)
  },
  [types.EDIT_NENDOROID_IN_INDEX] (state, nendoroid) {
    console.log('EDIT_NENDOROID_IN_INDEX')
    state.nendoroidsIndex.update(nendoroid)
  },
  [types.EDIT_ACCESSORY_IN_INDEX] (state, accessory) {
    console.log('EDIT_ACCESSORY_IN_INDEX')
    state.accessoriesIndex.update(accessory)
  },
  [types.EDIT_BODYPART_IN_INDEX] (state, bodypart) {
    console.log('EDIT_BODYPART_IN_INDEX')
    state.bodypartsIndex.update(bodypart)
  },
  [types.EDIT_FACE_IN_INDEX] (state, face) {
    console.log('EDIT_FACE_IN_INDEX')
    state.facesIndex.update(face)
  },
  [types.EDIT_HAIR_IN_INDEX] (state, hair) {
    console.log('EDIT_HAIR_IN_INDEX')
    state.hairsIndex.update(hair)
  },
  [types.EDIT_HAND_IN_INDEX] (state, hand) {
    console.log('EDIT_HAND_IN_INDEX')
    state.handsIndex.update(hand)
  },
  [types.EDIT_PHOTO_IN_INDEX] (state, photo) {
    console.log('EDIT_PHOTO_IN_INDEX')
    state.photosIndex.update(photo)
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
  doSearch ({commit, state}, payload) {
    return {
      'boxes': state.boxesIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'nendoroids': state.nendoroidsIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'accessories': state.accessoriesIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'bodyparts': state.bodypartsIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'faces': state.facesIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'hairs': state.hairsIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'hands': state.handsIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      }),
      'photos': state.photosIndex.search(payload.queryTerm, {
        expand: !payload.strictMode
      })
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
