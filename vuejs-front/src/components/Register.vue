<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Register a new membership</p>

      <div class="callout callout-danger" v-if="registration_status === USERNAME_ERROR || registration_status === USERMAIL_ERROR || registration_status === PASSWORD_ERROR || registration_status === REPASSWORD_ERROR || registration_status === AGREETERMS_ERROR">
        <h4>Registration unsuccessful</h4>
        <p>Please check the fields in red and try again...</p>
      </div>
      <div class="callout callout-danger" v-if="registration_status === REGISTER_FAIL">
        <h4>Registration unsuccessful</h4>
        <p>Please check your information and try again (or maybe the registration server is down)...</p>
      </div>

      <div class="callout callout-info" v-if="registration_status === REGISTER_SUCCESS">
        <h4>Registration successful</h4>
        <p>The registration was successful, you must receive in few minutes a mail with a confirmation code.</p>
      </div>
      <div class="callout callout-danger" v-if="registration_status === REGISTRATIONCODE_ERROR">
        <h4>Confirmation unsuccessful</h4>
        <p>Please provide a registration code...</p>
      </div>
      <div class="callout callout-danger" v-if="registration_status === CONFIRM_FAIL">
        <h4>Confirmation unsuccessful</h4>
        <p>Please check the registration code...</p>
      </div>
      <div class="callout callout-info" v-if="registration_status === CONFIRM_SUCCESS">
        <h4>Validation successful</h4>
        <p>You can now log in.</p>
        <router-link to="/login">Go to login page</router-link>
      </div>

      <p></p>

      <form action="#" method="post" @submit.prevent="onSubmit" v-if="registration_status < REGISTER_SUCCESS">
        <div class="form-group has-feedback" :class="registration_status === USERNAME_ERROR?'has-error':''">
          <input type="text" class="form-control" placeholder="Username" v-model="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <span class="help-block" v-if="registration_status === USERNAME_ERROR">The username is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="registration_status === USERMAIL_ERROR?'has-error':''">
          <input type="email" class="form-control" placeholder="Email" v-model="usermail">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block" v-if="registration_status === USERMAIL_ERROR">The e-mail is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="registration_status === PASSWORD_ERROR?'has-error':''">
          <input type="password" class="form-control" placeholder="Password" v-model="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" v-if="registration_status === PASSWORD_ERROR">The password is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="registration_status === REPASSWORD_ERROR?'has-error':''">
          <input type="password" class="form-control" placeholder="Retype assword" v-model="repassword">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <span class="help-block" v-if="registration_status === REPASSWORD_ERROR">The passwords don't match</span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="form-group" :class="registration_status === AGREETERMS_ERROR?'has-error':''">
              <input id="agreeterms" name="agreeterms" type="checkbox" v-model="agreeterms">
              <label for="agreeterms">I agree to the terms</label>
              <span class="help-block" v-if="registration_status === AGREETERMS_ERROR">You must agree to the terms</span>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <form action="#" method="post" @submit.prevent="onSubmitCode" v-if="registration_status >= REGISTER_SUCCESS && registration_status < CONFIRM_SUCCESS">
        <p>Please enter the registration code bellow</p>
        <div class="form-group has-feedback" :class="registration_status === REGISTRATIONCODE_ERROR?'has-error':''">
          <input type="text" class="form-control" placeholder="Registration code" v-model="registrationcode">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" v-if="registration_status === REGISTRATIONCODE_ERROR">The registration code cannot be empty</span>
        </div>
        <div class="row">
          <div class="col-xs-8">
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Confirm</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

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
      registrationcode: null,
      // registration_status: CODE & current value
      INITIAL_STATE: 0,
      SUBMIT_REGISTER: 1,
      USERNAME_ERROR: 2,
      USERMAIL_ERROR: 3,
      PASSWORD_ERROR: 4,
      REPASSWORD_ERROR: 5,
      AGREETERMS_ERROR: 6,
      REGISTER_FAIL: 7,
      REGISTER_SUCCESS: 8,
      SUBMIT_CONFIRM: 9,
      REGISTRATIONCODE_ERROR: 10,
      CONFIRM_FAIL: 11,
      CONFIRM_SUCCESS: 12,
      registration_status: 0
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'user'])
  },
  methods: {
    ...Vuex.mapActions(['login', 'retrieveData']),
    onSubmit () {
      this.registration_status = this.SUBMIT_REGISTER

      if (this.username === null) {
        this.registration_status = this.USERNAME_ERROR
      } else if (this.usermail === null) {
        this.registration_status = this.USERMAIL_ERROR
      } else if (this.password === null) {
        this.registration_status = this.PASSWORD_ERROR
      } else if (this.password !== this.repassword) {
        this.registration_status = this.REPASSWORD_ERROR
      } else if (!this.agreeterms) {
        this.registration_status = this.AGREETERMS_ERROR
      } else {
        console.log('Register user')

        let userinfo = {username: this.username, usermail: this.usermail, password: this.password}

        this.$http.post('auth/register', userinfo).then((response) => {
          console.log(response)
          this.registration_status = this.REGISTER_SUCCESS
        }, (response) => {
          this.registration_status = this.REGISTER_FAIL
        })
      }
    },
    onSubmitCode () {
      this.registration_status = this.SUBMIT_CONFIRM

      if (this.registrationcode === null) {
        this.registration_status = this.REGISTRATIONCODE_ERROR
      } else {
        console.log('Confirm user')

        let confirminfo = {usermail: this.usermail, registrationcode: this.registrationcode}

        this.$http.post('auth/confirm', confirminfo).then((response) => {
          this.registration_status = this.CONFIRM_SUCCESS
        }, (response) => {
          this.registration_status = this.CONFIRM_FAIL
        })
      }
    }
  }
}
</script>
