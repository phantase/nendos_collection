<template>
  <div class="db-box" v-if="!noeditableuser">

    <div class="row">
      <div class="col-md-12">
        <div class="box" v-if="isself">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-id-card-o"></i> Change mail and/or name</h3>
          </div>
          <form role="form">
            <div class="box-body">
              <div class="alert alert-danger" v-if="failureMailName">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errormail?'has-error':''">
                    <label>Mail</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Mail" v-model="usermail">
                    <span class="help-block" v-if="errormail">The mail is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorname?'has-error':''">
                    <label>Name</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Name" v-model="username">
                    <span class="help-block" v-if="errorname">The name is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="erroroldpass?'has-error':''">
                    <label>Password</label>
                    <input type="password" class="form-control" maxlength="100" placeholder="Password" v-model="useroldpass">
                    <span class="help-block" v-if="erroroldpass">The password is mandatory for any modification</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
              <button type="submit" class="btn btn-info pull-right" @click.prevent="submitMailName">Update user's Mail & Name</button>
            </div>
          </form>
        </div>
        <div class="box" v-if="canadmin && !isself">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-check-square-o"></i> Change user's rights</h3>
          </div>
          <div class="box-body">
            <div class="alert alert-danger" v-if="failureRights">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
            </div>
            <form role="form">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <input id="useradministrator" name="useradministrator" type="checkbox" v-model="useradministrator">
                    <label for="useradministrator"><i class="fa fa-gavel"></i> Administrator</label>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <input id="uservalidator" name="uservalidator" type="checkbox" v-model="uservalidator">
                    <label for="uservalidator"><i class="fa fa-check-square-o"></i>Validator</label>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <input id="usereditor" name="usereditor" type="checkbox" v-model="usereditor">
                    <label for="usereditor"><i class="fa fa-pencil-square-o"></i> Editor</label>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submitRights">Update user's rights</button>
              </div>
            </form>
          </div>
        </div>
        <div class="box" v-if="isself">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-key"></i> Edit a user [Password]</h3>
          </div>
          <div class="box-body">
            <div class="alert alert-danger" v-if="failurePassword">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
            </div>
            <form role="form">
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="erroroldpass2?'has-error':''">
                    <label>Current password</label>
                    <input type="password" class="form-control" maxlength="100" placeholder="Current password" v-model="useroldpass2">
                    <span class="help-block" v-if="erroroldpass2">The current password is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errornewpass?'has-error':''">
                    <label>New password</label>
                    <input type="password" class="form-control" maxlength="100" placeholder="New password" v-model="usernewpass">
                    <span class="help-block" v-if="errornewpass">The new password is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errornewpasscheck?'has-error':''">
                    <label>New password (confirmation)</label>
                    <input type="password" class="form-control" maxlength="100" placeholder="New password (confirmation)" v-model="usernewpasscheck">
                    <span class="help-block" v-if="errornewpasscheck">The confirmation and the password don't match</span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submitPassword">Update user's password</button>
              </div>
            </form>
          </div>
        </div>
        <div class="box" v-if="!(isself || canadmin)">
          <div class="box-body">
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to edit a user.
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row" v-else>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Not found</h3>
        </div>
        <div class="box-body">
          <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            What you are looking for was not found, please check again the information you enter.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import router from './../../router'
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

export default {
  name: 'FormUser',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      noeditableuser: false,
      failureMailName: false,
      usermail: null,
      errormail: false,
      username: null,
      errorname: false,
      useroldpass: null,
      erroroldpass: false,
      failurePassword: false,
      useroldpass2: null,
      erroroldpass2: false,
      usernewpass: null,
      errornewpass: false,
      usernewpasscheck: null,
      errornewpasscheck: false,
      failureRights: false,
      useradministrator: null,
      uservalidator: null,
      usereditor: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['users', 'user', 'canadmin']),
    canedituser () {
      return true
    },
    internalid () {
      return this.$route.params.id
    },
    isself () {
      return this.$route.params.id === this.user.internalid
    }
  },
  watch: {
    internalid () {
      this.cancel()
    }
  },
  methods: {
    ...Vuex.mapActions(['updateUserMailName', 'updateUserPassword', 'updateUserRights']),
    retrieveUserParams () {
      let user = this.users.find(user => user.internalid === this.internalid)
      if (user) {
        this.usermail = user.usermail
        this.username = user.username
        this.useradministrator = user.administrator === '1'
        this.uservalidator = user.validator === '1'
        this.usereditor = user.editor === '1'
        this.noeditableuser = false
      } else {
        this.noeditableuser = true
      }
    },
    cancel () {
      this.failureMailName = false
      this.failurePassword = false
      this.failureRights = false
      this.usermail = null
      this.username = null
      this.useroldpass = null
      this.useroldpass2 = null
      this.usernewpass = null
      this.usernewpasscheck = null
      this.useradministrator = null
      this.uservalidator = null
      this.usereditor = null
      this.errormail = false
      this.errorname = false
      this.erroroldpass = false
      this.erroroldpass2 = false
      this.errornewpass = false
      this.errornewpasscheck = false
      this.retrieveUserParams()
    },
    checkFormMailName () {
      this.errormail = false
      this.errorname = false
      this.erroroldpass = false
      if (this.usermail === null || this.usermail.length === 0) {
        this.errormail = true
      }
      if (this.username === null || this.username.length === 0) {
        this.errorname = true
      }
      if (this.useroldpass === null || this.useroldpass.length === 0) {
        this.erroroldpass = true
      }
    },
    checkFormPassword () {
      this.erroroldpass2 = false
      this.errornewpass = false
      this.errornewpasscheck = false
      if (this.useroldpass2 === null || this.useroldpass2.length === 0) {
        this.erroroldpass2 = true
      }
      if (this.usernewpass === null || this.usernewpass.length === 0) {
        this.errornewpass = true
      }
      if (this.usernewpasscheck === null || this.usernewpasscheck.length === 0) {
        this.errornewpasscheck = true
      }
    },
    submitMailName () {
      this.checkFormMailName()
      if (!(this.errormail || this.errorname || this.erroroldpass)) {
        console.log('Submit new Mail & Name')
        let body = {}
        body.usermail = this.usermail
        body.username = this.username
        body.oldpassword = this.useroldpass
        this.updateUserMailName({
          'context': this,
          'body': body,
          'internalid': this.internalid
        }).then(response => {
          console.log('Edition successful')
          router.push('/user/' + response)
        }, response => {
          console.log('Edition failed')
          this.failureMailName = true
        })
      }
    },
    submitRights () {
      console.log('Submit new Rights')
      let body = {}
      body.administrator = this.useradministrator ? 1 : 0
      body.validator = this.uservalidator ? 1 : 0
      body.editor = this.usereditor ? 1 : 0
      this.updateUserRights({
        'context': this,
        'body': body,
        'internalid': this.internalid
      }).then(response => {
        console.log('Edition successful')
        router.push('/user/' + response)
      }, response => {
        console.log('Edition failed')
        this.failureRights = true
      })
    },
    submitPassword () {
      this.checkFormPassword()
      if (!(this.erroroldpass2 || this.errornewpass || this.errornewpasscheck)) {
        console.log('Submit new Password')
        let body = {}
        body.oldpassword = this.useroldpass2
        body.newpassword = this.usernewpass
        body.usermail = this.user.usermail
        body.username = this.user.username
        this.updateUserPassword({
          'context': this,
          'body': body,
          'internalid': this.internalid
        }).then(response => {
          console.log('Edition successful')
          router.push('/user/' + response)
        }, response => {
          console.log('Edition failed')
          this.failurePassword = true
        })
      }
    }
  },
  mounted () {
    this.cancel()
  }
}
</script>

<style scoped>
</style>
