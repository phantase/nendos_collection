<template>
  <div class="db-box" v-if="userprofile">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="pull-right">
                <div><router-link :to="'/user/'+userprofile.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canadmin || isself"><i class="fa fa-edit"></i> Edit</router-link></div>
              </div>
              <div class="db-box-category text-yellow">
                <span>{{ userprofile.username }}</span>
              </div>
              <div class="db-box-name" v-if="canadmin || isself">{{ userprofile.usermail }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Informations" collapsable="true" icon="fa-info"></app-box-header>
          <div class="box-body">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Name</b>
                <a class="pull-right">{{ userprofile.username }}</a><br>
              </li>
              <li class="list-group-item" v-if="canadmin || isself">
                <b>Mail</b>
                <a class="pull-right">{{ userprofile.usermail }}</a><br>
              </li>
              <li class="list-group-item">
                <b>Roles</b>
                <a class="pull-right">
                  <i class="fa fa-gavel" data-toggle="tooltip" title="Administrator" v-if="userprofile.administrator === '1'"></i>
                  <i class="fa fa-check-square-o" data-toggle="tooltip" title="Validator" v-if="userprofile.validator === '1'"></i>
                  <i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Editor" v-if="userprofile.editor === '1'"></i>
                  <i class="fa fa-user-circle-o" data-toggle="tooltip" title="User"></i>
                </a><br>
              </li>
              <li class="list-group-item" v-if="userprofile.signupdate">
                <b>Sign-up date</b>
                <a class="pull-right">{{ userprofile.signupdate }}</a><br>
              </li>
              <li class="list-group-item" v-if="userprofile.lastviewdate">
                <b>Last view date</b>
                <a class="pull-right">{{ userprofile.lastviewdate }}</a><br>
              </li>
            </ul>
            <div class="pull-middle">
                <router-link class="btn btn-warning" :to="'/user/'+userprofile.internalid+'/collection'"><i class="fa fa-cube"></i> Collection</router-link>
                <router-link class="btn btn-warning" :to="'/user/'+userprofile.internalid+'/photos'"><i class="fa fa-image"></i> Photos</router-link>
                <router-link class="btn btn-warning" :to="'/user/'+userprofile.internalid+'/favorites'"><i class="fa fa-heart"></i> Favorites</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canadmin || isself" :editlink="'/user/'+userprofile.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/users/'+userprofile.internalid+'/thumb'" v-if="userprofile.haspicture == '1'"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
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
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'

export default {
  name: 'User',
  components: {
    AppBoxHeader
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['users', 'user', 'canadmin']),
    userprofile () {
      return this.users.find(user => user.internalid === this.$route.params.id)
    },
    isself () {
      return this.user.internalid === this.$route.params.id
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.userprofile) {
        document.title += ' / ' + vm.userprofile.username + ' / Id: ' + vm.userprofile.internalid
      } else {
        document.title += ' / Id: ' + vm.$route.params.id
      }
    })
  }
}
</script>

<style scoped>
  .list-group-item a {
    width: calc(100% - 8em);
    text-align: right;
  }
  .pull-right+br {
    clear: both;
  }
  .pull-middle {
    text-align: center;
  }
</style>
