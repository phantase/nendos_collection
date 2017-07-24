<template>
  <div class="db-box" v-if="user">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="pull-right">
                <div><router-link :to="'/user/'+user.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canadmin || isself"><i class="fa fa-edit"></i> Edit</router-link></div>
              </div>
              <div class="db-box-category text-yellow">
                <span>{{ user.username }}</span>
              </div>
              <div class="db-box-name" v-if="canadmin || isself">{{ user.usermail }}</div>
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
                <a class="pull-right">{{ user.username }}</a><br>
              </li>
              <li class="list-group-item" v-if="canadmin || isself">
                <b>Mail</b>
                <a class="pull-right">{{ user.usermail }}</a><br>
              </li>
              <li class="list-group-item">
                <b>Roles</b>
                <a class="pull-right">
                  <i class="fa fa-gavel" data-toggle="tooltip" title="Administrator" v-if="user.administrator === '1'"></i>
                  <i class="fa fa-check-square-o" data-toggle="tooltip" title="Validator" v-if="user.validator === '1'"></i>
                  <i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Editor" v-if="user.editor === '1'"></i>
                  <i class="fa fa-user-circle-o" data-toggle="tooltip" title="User"></i>
                </a><br>
              </li>
              <li class="list-group-item" v-if="user.signupdate">
                <b>Sign-up date</b>
                <a class="pull-right">{{ user.signupdate }}</a><br>
              </li>
              <li class="list-group-item" v-if="user.lastviewdate">
                <b>Last view date</b>
                <a class="pull-right">{{ user.lastviewdate }}</a><br>
              </li>
            </ul>
            <div class="pull-middle">
                <router-link class="btn btn-warning" :to="'/user/'+user.internalid+'/collection'"><i class="fa fa-cube"></i> Collection</router-link>
                <router-link class="btn btn-warning" :to="'/user/'+user.internalid+'/photos'"><i class="fa fa-image"></i> Photos</router-link>
                <router-link class="btn btn-warning" :to="'/user/'+user.internalid+'/favorites'"><i class="fa fa-heart"></i> Favorites</router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canadmin || isself" :editlink="'/user/'+user.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/users/'+user.internalid+'/thumb'" v-if="user.haspicture == '1'"/>
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
    user () {
      return this.users.find(user => user.internalid === this.$route.params.id)
    },
    isself () {
      return this.user.internalid === this.$route.params.id
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.user) {
        document.title += ' / ' + vm.user.username + ' / Id: ' + vm.user.internalid
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
