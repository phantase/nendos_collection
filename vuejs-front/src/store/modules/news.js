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
  [types.SET_NEWS] (state, news) {
    state.news = news
  }
}

const actions = {
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
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
