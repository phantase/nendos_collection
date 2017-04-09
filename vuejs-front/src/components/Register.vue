<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="#" method="post" @submit.prevent="onSubmit">
        <div class="form-group has-feedback" :class="errorusername?'has-error':''">
          <input type="text" class="form-control" placeholder="Username" v-model="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <span class="help-block" v-if="errorusername">The username is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="errorusermail?'has-error':''">
          <input type="email" class="form-control" placeholder="Email" v-model="usermail">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block" v-if="errorusermail">The e-mail is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="errorpassword?'has-error':''">
          <input type="password" class="form-control" placeholder="Password" v-model="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" v-if="errorpassword">The password is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="errorrepassword?'has-error':''">
          <input type="password" class="form-control" placeholder="Retype assword" v-model="repassword">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <span class="help-block" v-if="errorrepassword">The passwords don't match</span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="form-group" :class="erroragreeterms?'has-error':''">
              <input id="agreeterms" name="agreeterms" type="checkbox" v-model="agreeterms">
              <label for="agreeterms">I agree to the terms</label>
              <span class="help-block" v-if="erroragreeterms">You must agree to the terms</span>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p></p>

      <div class="callout callout-danger" v-show="registererror">
        <h4>Login unsuccessful</h4>
        <p>Please check your credential and try again...</p>
      </div>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
</template>

<script>
// import router from './../router'
import store from './../store'
import Vuex from 'vuex'

export default {
  name: 'Register',
  store: store,
  data () {
    return {
      username: null,
      usermail: null,
      password: null,
      repassword: null,
      agreeterms: false,
      registererror: false,
      errorusername: false,
      errorusermail: false,
      errorpassword: false,
      errorrepassword: false,
      erroragreeterms: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'user'])
  },
  methods: {
    ...Vuex.mapActions(['login', 'retrieveData']),
    onSubmit () {
      this.registererror = false
      this.errorusername = false
      this.errorusermail = false
      this.errorpassword = false
      this.errorrepassword = false
      this.erroragreeterms = false

      if (this.username === null) {
        this.registererror = true
        this.errorusername = true
      } else if (this.usermail === null) {
        this.registererror = true
        this.errorusermail = true
      } else if (this.password === null) {
        this.registererror = true
        this.errorpassword = true
      } else if (this.password !== this.repassword) {
        this.registererror = true
        this.errorrepassword = true
      } else if (!this.agreeterms) {
        this.registererror = true
        this.erroragreeterms = true
      }

      // let credentials = {username: this.username, usermail: this.usermail, password: this.password}

      console.log('Register user')

      // this.login({
      //   'credentials': credentials,
      //   'context': this
      // }).then(() => {
      //   this.retrieveData({'context': this})
      //   router.replace('/')
      // }, () => {
      //   this.registererror = true
      // })
    }
  }
}
</script>
