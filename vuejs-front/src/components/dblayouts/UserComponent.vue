<template>
  <span class="user">
    <i class="fa fa-user-circle-o"></i> <router-link :to="'/user/' + user.internalid" v-if="user">{{ user.username }}</router-link><span v-else>Unknown</span>
  </span>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

export default {
  name: 'UserComponent',
  store: store,
  props: ['userid'],
  data () {
    return {
    }
  },
  computed: {
    ...Vuex.mapGetters(['users']),
    user () {
      return this.users.find(user => user.internalid === this.userid)
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}
</script>
