import * as types from '../mutation-types.js'

const state = {
  users: [],
  usersLoadedDate: null
}

const getters = {
  users (state) {
    return state.users
  },
  countusers (state) {
    return state.users.length
  },
  usersLoadedDate (state) {
    return state.usersLoadedDate
  }
}

const mutations = {
  [types.SET_USERS] (state, users) {
    state.users = users
    state.usersLoadedDate = new Date()
  },
  [types.EDIT_USER_MAILNAME] (state, payload) {
    let userid = payload.userid
    let usermail = payload.usermail
    let username = payload.username
    state.users.find(user => user.internalid === userid).usermail = usermail
    state.users.find(user => user.internalid === userid).username = username
  },
  [types.EDIT_USER_PASSWORD] (state, payload) {
    // Nothing to do
  },
  [types.EDIT_USER_RIGHTS] (state, payload) {
    let userid = payload.userid
    let administrator = payload.administrator
    let validator = payload.validator
    let editor = payload.editor
    state.users.find(user => user.internalid === userid).administrator = administrator
    state.users.find(user => user.internalid === userid).validator = validator
    state.users.find(user => user.internalid === userid).editor = editor
  },
  [types.ADD_USER_PICTURE] (state, internalid) {
    let idx = state.users.findIndex(intuser => intuser.internalid === internalid)
    state.users[idx].haspicture = 1
  }
}

const actions = {
  setUsers (store, users) {
    store.commit(types.SET_USERS, users)
  },
  retrieveUsers (store, payload) {
    let context = payload.context
    return new Promise((resolve, reject) => {
      context.$http.get('users', {
        before (request) {
          if (this.previousUsersRequest) {
            this.previousUsersRequest.abort()
          }
          this.previousUsersRequest = request
        }
      }).then((response) => {
        store.dispatch('setUsers', response.data)
        resolve()
      }, (response) => {
        reject()
      })
    })
  },
  editUserMailName (store, response) {
    let payload = {
      'userid': response.user.internalid,
      'usermail': response.user.usermail,
      'username': response.user.username
    }
    store.commit(types.EDIT_USER_MAILNAME, payload)
    store.dispatch('setUser', response.user)
    store.dispatch('setToken', response.token)
  },
  editUserRights (store, user) {
    let payload = {
      'userid': user.internalid,
      'administrator': user.administrator,
      'validator': user.validator,
      'editor': user.editor
    }
    store.commit(types.EDIT_USER_RIGHTS, payload)
  },
  updateUserMailName (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('user/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editUserMailName', response.data)
        resolve(response.data.user.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateUserPassword (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('user/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        resolve(response.data.user.internalid)
      }, response => {
        reject()
      })
    })
  },
  updateUserRights (store, payload) {
    let context = payload.context
    let body = payload.body
    let internalid = payload.internalid
    return new Promise((resolve, reject) => {
      context.$http.put('user/' + internalid, body, {
        // emulateHTTP: true,
        // emulateJSON: true
      }).then(response => {
        store.dispatch('editUserRights', response.data)
        resolve(response.data.internalid)
      }, response => {
        reject()
      })
    })
  },
  addUserPicture (store, payload) {
    let internalid = payload.internalid
    store.commit(types.ADD_USER_PICTURE, internalid)
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
