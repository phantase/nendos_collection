<template>
          <li class="dropdown messages-menu hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_nendo"></i>
              <span class="label label-info" v-if="nendoroidsLoadedPartially">Partial</span>
              <span class="label label-success" v-else-if="nendoroidsLoadedDate">Full</span>
              <span class="label label-danger" v-else>Loading</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="nendoroidsLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ nendoroidsLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadNendoroids">Reload nendoroids</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusNendoroids',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['nendoroids', 'nendoroidsLoadedDate', 'nendoroidsLoadedPartially'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveNendoroids']),
      reloadNendoroids () {
        this.retrieveNendoroids({
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
