// import router from './../router'

export default {
  user: {
    authenticated: false
  },
  login (context, credentials) {
    context.$http.post('auth/login', credentials).then((response) => {
      localStorage.setItem('token', response.data.token)
      this.user.authenticated = true

      context.$http.get('auth/whoiam').then((response) => {
        console.log('success of whoiam')
        console.log(response.data)
      }, (response) => {
        console.log('faillure of whoiam')
        console.log(response)
      })

      // router.replace('/')
    }, (response) => {
      context.loginerror = true
    })
  },
  register (context, credentials) {
    // Todo
  },
  logout () {
    // Todo
  },
  checkAuth () {
    // Todo
  },
  getToken () {
    return localStorage.getItem('token')
  }
}
