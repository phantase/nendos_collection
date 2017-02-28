<template>
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <router-link to="/"><b>Nendoroids</b> db</router-link>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">&nbsp;</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img :src="resources.imagesurl+'/images/nendos/users/'+(user?user.internalid:'0')+'_thumb'" alt="User Image">
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
  </div>
  <!-- /.center -->
</template>

<script>
import Resources from './../config/resources'
import router from './../router'
import store from './../store'
import Vuex from 'vuex'

export default {
  name: 'Login',
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
