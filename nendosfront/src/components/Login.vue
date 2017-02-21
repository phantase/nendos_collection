<template>
  <div class="login-box">
    <div class="login-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post" @submit.prevent="onSubmit">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" v-model="usermail">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" v-model="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <input id="rememberme" name="rememberme" type="checkbox" v-model="rememberme">
            <label for="rememberme">Remember Me</label>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-warning btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p></p>

      <div class="callout callout-danger" v-show="loginerror">
        <h4>Login unsuccessful</h4>
        <p>Please check your credential and try again...</p>
      </div>

      <router-link to="forgotpass">I forgot my password</router-link><br>
      <router-link to="register" class="text-center">Register a new membership</router-link>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
</template>

<script>
import router from './../router'
import store from './../store'
import Vuex from 'vuex'

export default {
  name: 'Login',
  store: store,
  data () {
    return {
      usermail: 'phantase@phantase.com',
      password: 'phantase',
      rememberme: false,
      loginerror: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'user'])
  },
  methods: {
    ...Vuex.mapActions(['login']),
    onSubmit () {
      this.loginerror = false

      let credentials = {usermail: this.usermail, password: this.password, rememberme: this.rememberme}

      this.login({
        'credentials': credentials,
        'context': this
      }).then(() => {
        router.replace('/')
      }, () => {
        this.loginerror = true
      })
    }
  }
}
</script>
