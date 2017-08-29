<template>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_body"></i>
              <span class="label label-info" v-if="bodypartsLoadedPartially">Partial</span>
              <span class="label label-success" v-else-if="bodypartsLoadedDate">Full</span>
              <span class="label label-danger" v-else>Loading</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="bodypartsLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ bodypartsLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadBodyparts">Reload bodyparts</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusBodyparts',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['bodyparts', 'bodypartsLoadedDate', 'bodypartsLoadedPartially'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveBodyparts']),
      reloadBodyparts () {
        this.retrieveBodyparts({
          'context': this
        })
      }
    }
  }
</script>

<style scoped>
  a {
    cursor: pointer;
  }
</style>
