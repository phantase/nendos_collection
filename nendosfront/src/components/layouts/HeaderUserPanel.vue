<template>
  <!-- User Account Menu -->
  <li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <!-- The user image in the navbar-->
      <img :src="resources.imagesurl+'/images/nendos/users/'+(user.internalid?user.internalid:'0')+'_thumb'" class="user-image" alt="User Image">
      <!-- hidden-xs hides the username on small devices so only the image appears. -->
      <span class="hidden-xs">{{ user.internalid ? user.username : 'Unknow user' }}</span>
    </a>
    <ul class="dropdown-menu">
      <!-- The user image in the menu -->
      <li class="user-header">
        <img :src="resources.imagesurl+'/images/nendos/users/'+(user.internalid?user.internalid:'0')+'_thumb'" class="img-circle" alt="User Image">

        <p>
          {{ user.internalid ? user.username : 'Unknow user' }}
          <small v-if="user.internalid">Member since {{ resources.month_names[(new Date(user.signupdate)).getMonth()] }} {{ (new Date(user.signupdate)).getFullYear() }} </small>
        </p>
      </li>
      <!-- Menu Body -->
      <li class="user-body" v-if="user.internalid">
        <div class="row">
          <div class="col-xs-4 text-center">
            <a href="#">Followers</a>
          </div>
          <div class="col-xs-4 text-center">
            <a href="#">Sales</a>
          </div>
          <div class="col-xs-4 text-center">
            <a href="#">Friends</a>
          </div>
        </div>
        <!-- /.row -->
      </li>
      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <router-link to="/profile"  v-if="user.internalid" class="btn btn-default btn-flat">Profile</router-link>
          <router-link to="/signin"  v-else class="btn btn-default btn-flat">Sign in</router-link>
        </div>
        <div class="pull-right">
          <router-link to="/logout" v-if="user.internalid" class="btn btn-default btn-flat">Log out</router-link>
          <router-link to="/login" v-else class="btn btn-default btn-flat">Log in</router-link>
        </div>
      </li>
    </ul>
  </li>
</template>

<script>
  import Resources from './../../config/resources'
  import store from './../../store'

  export default {
    name: 'HeaderUserPanel',
    store: store,
    data () {
      return {
        resources: Resources
      }
    },
    computed: {
      user () {
        return store.getters.user
      }
    }
  }
</script>
