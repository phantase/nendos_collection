import * as types from '../mutation-types.js'

const state = {
  news: []
}

const getters = {
  news (state) {
    return state.news
  },
  countnews (state) {
    return state.news.length
  }
}

const mutations = {
  [types.ADD_NEWS] (state, singleNews) {
    state.news.push(singleNews)
  },
  [types.EDIT_NEWS] (state, singleNews) {
    let idx = state.news.findIndex(intsingleNews => intsingleNews.internalid === singleNews.internalid)
    state.news[idx] = singleNews
  },
  [types.SET_NEWS] (state, news) {
    state.news = news
  }
}

const actions = {
  addNews (store, singleNews) {
    store.commit(types.ADD_NEWS, singleNews)
  },
  editNews (store, singleNews) {
    store.commit(types.EDIT_NEWS, singleNews)
  },
  setNews (store, news) {
    store.commit(types.SET_NEWS, news)
  },
  retrieveNews (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('news', {
        before (request) {
          if (this.previousNewsRequest) {
            this.previousNewsRequest.abort()
          }
          this.previousNewsRequest = request
        }
      }).then((response) => {
        store.dispatch('setNews', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  createNews (store, payload) {
    let context = payload.context
    let formData = payload.formData
    return new Promise((resolve, reject) => {
      context.$http.post('news', formData).then(response => {
        store.dispatch('addNews', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateNews (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('news/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editNews', response.data)
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
