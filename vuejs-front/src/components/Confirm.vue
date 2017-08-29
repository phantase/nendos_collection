<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Confirm your membership</p>

      <div class="callout callout-danger" v-if="confirm_status === REGISTRATIONCODE_ERROR">
        <h4>Confirmation unsuccessful</h4>
        <p>Please provide a registration code...</p>
      </div>
      <div class="callout callout-danger" v-if="confirm_status === CONFIRM_FAIL">
        <h4>Confirmation unsuccessful</h4>
        <p>Please check the registration code...</p>
      </div>
      <div class="callout callout-info" v-if="confirm_status === CONFIRM_SUCCESS">
        <h4>Validation successful</h4>
        <p>You can now log in.</p>
        <router-link to="/login">Go to login page</router-link>
      </div>

      <p></p>

      <form action="#" method="post" @submit.prevent="onSubmitCode" v-if="confirm_status < CONFIRM_SUCCESS">
        <div class="form-group has-feedback" :class="confirm_status === USERMAIL_ERROR?'has-error':''">
          <input type="email" class="form-control" placeholder="Email" v-model="usermail">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block" v-if="confirm_status === USERMAIL_ERROR">The e-mail is mandatory</span>
        </div>
        <div class="form-group has-feedback" :class="confirm_status === REGISTRATIONCODE_ERROR?'has-error':''">
          <input type="text" class="form-control" placeholder="Registration code" v-model="registrationcode">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block" v-if="confirm_status === REGISTRATIONCODE_ERROR">The registration code cannot be empty</span>
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

export default {
  name: 'Confirm',
  store: store,
  data () {
    return {
      usermail: null,
      registrationcode: null,
      // confirm: CODE & current value
      INITIAL_STATE: 0,
      USERMAIL_ERROR: 1,
      REGISTRATIONCODE_ERROR: 2,
      SUBMIT_CONFIRM: 3,
      CONFIRM_FAIL: 4,
      CONFIRM_SUCCESS: 5,
      confirm_status: 0
    }
  },
  methods: {
    onSubmitCode () {
      this.confirm_status = this.SUBMIT_CONFIRM

      if (this.usermail === null) {
        this.confirm_status = this.USERMAIL_ERROR
      } else if (this.registrationcode === null) {
        this.confirm_status = this.REGISTRATIONCODE_ERROR
      } else {
        console.log('Confirm user')

        let confirminfo = {usermail: this.usermail, registrationcode: this.registrationcode}

        this.$http.post('auth/confirm', confirminfo).then((response) => {
          this.confirm_status = this.CONFIRM_SUCCESS
        }, (response) => {
          this.confirm_status = this.CONFIRM_FAIL
        })
      }
    }
  }
}
</script>
