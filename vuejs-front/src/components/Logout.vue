<template>
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">&nbsp;</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item" v-if="authenticated">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img :src="resources.img_url+'/images/users/'+(user?user.internalid:'0')+'/thumb'" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials">
        <div class="input-group" @click="doLogout">
          <button type="button" class="form-control" placeholder="password" value="Logout">Logout</button>

          <div class="input-group-btn">
            <button type="button" class="btn"><i class="fa fa-close text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->

    </div>
    <div class="lockscreen-item" v-else>
      <div class="callout callout-danger">
        <h4>You're not logged in!</h4>

        <p>Why do you want to log out, you're not logged in???</p>
      </div>
    </div>
  </div>
  <!-- /.center -->
</template>

<script>
import Resources from './../config/resources'
import router from './../router'
import store from './../store'
import Vuex from 'vuex'

export default {
  name: 'Logout',
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'user'])
  },
  methods: {
    ...Vuex.mapActions(['logout', 'resetUserCounts', 'retrieveData']),
    doLogout () {
      this.logout().then(() => {
        this.resetUserCounts({'context': this})
        this.retrieveData({'context': this})
        router.replace('/')
      })
    }
  }
}
</script>
