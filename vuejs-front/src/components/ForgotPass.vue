<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Request a new password</p>

      <div class="callout callout-danger" v-show="submission_status === USERMAIL_ERROR || submission_status === VERIFICATIONCODE_ERROR">
        <h4>Submission unsuccessful</h4>
        <p>Please check the fields in red and try again...</p>
      </div>
      <div class="callout callout-danger" v-show="submission_status === SUBMISSION_FAIL">
        <h4>Submission unsuccessful</h4>
        <p>Something went wrong when you submit your request, please try again...</p>
      </div>
      <div class="callout callout-info" v-if="submission_status === SUBMISSION_SUCCESS">
        <h4>Submission successful</h4>
        <p>The Submission was successful, you must receive in few minutes a mail with a confirmation code.</p>
      </div>
      <div class="callout callout-info" v-if="submission_status === CONFIRM_SUCCESS">
        <h4>Validation successful</h4>
        <p>You must receive a mail with a new password, use it to log in.</p>
        <router-link to="/login">Go to login page</router-link>
      </div>

      <p></p>

      <form action="#" method="post" @submit.prevent="onSubmit" v-if="submission_status < SUBMISSION_SUCCESS">
        <div class="form-group has-feedback" :class="submission_status === USERMAIL_ERROR?'has-error':''">
          <input type="email" class="form-control" placeholder="Email" v-model="usermail">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block" v-if="submission_status === USERMAIL_ERROR">The mail is mandatory</span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Help me!!!</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <form action="#" method="post" @submit.prevent="onSubmitCode" v-if="submission_status >= SUBMISSION_SUCCESS && submission_status < CONFIRM_SUCCESS">
        <p>Please enter the confirmation code bellow</p>
        <div class="form-group has-feedback" :class="submission_status === VERIFICATIONCODE_ERROR?'has-error':''">
          <input type="text" class="form-control" placeholder="Confirmation code" v-model="confirmationcode">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" v-if="submission_status === VERIFICATIONCODE_ERROR">The confirmation code cannot be empty</span>
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
  name: 'Login',
  store: store,
  data () {
    return {
      usermail: process.env.DEFAULT_USERNAME,
      confirmationcode: null,
      // submission_status: CODE and current value
      INITIAL_STATE: 0,
      USERMAIL_ERROR: 1,
      SUBMIT_MAIL: 2,
      SUBMISSION_FAIL: 3,
      SUBMISSION_SUCCESS: 4,
      SUBMIT_CONFIRM: 5,
      VERIFICATIONCODE_ERROR: 6,
      CONFIRM_FAIL: 7,
      CONFIRM_SUCCESS: 8,
      submission_status: 0
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'user'])
  },
  methods: {
    ...Vuex.mapActions(['login', 'retrieveData']),
    onSubmit () {
      if (this.usermail === null || this.usermail.length < 1) {
        this.submission_status = this.USERMAIL_ERROR
      } else {
        this.submission_status = this.SUBMIT_MAIL

        let credentials = {usermail: this.usermail}

        this.$http.post('auth/forgotpass', credentials).then((response) => {
          console.log(response)
          this.submission_status = this.SUBMISSION_SUCCESS
        }, (response) => {
          this.submission_status = this.SUBMISSION_FAIL
        })
      }
    },
    onSubmitCode () {
      this.submission_status = this.SUBMIT_CONFIRM

      if (this.confirmationcode === null) {
        this.submission_status = this.VERIFICATIONCODE_ERROR
      } else {
        console.log('Confirm user')

        let confirminfo = {usermail: this.usermail, requestcode: this.confirmationcode}

        this.$http.post('auth/confirmforgot', confirminfo).then((response) => {
          this.submission_status = this.CONFIRM_SUCCESS
        }, (response) => {
          this.submission_status = this.CONFIRM_FAIL
        })
      }
    }
  }
}
</script>
