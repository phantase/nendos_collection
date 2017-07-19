<template>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
        <img :src="resources.img_url+'/images/users/'+(user.internalid?user.internalid:'0')+'/thumb'" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
          <p>{{ user.internalid ? user.username : 'Unknow user' }}</p>
          <!-- Status -->
          <a v-if="user.internalid"><i class="fa fa-circle text-success"></i> Online</a>
          <router-link to="/login" v-else><i class="fa fa-circle text-success"></i> Log me in</router-link>
        </div>
      </div>
</template>

<script>
  import Resources from './../../config/resources'
  import store from './../../store'

  export default {
    name: 'SidebarUserPanel',
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
