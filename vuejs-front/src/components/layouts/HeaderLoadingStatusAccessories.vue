<template>
          <li class="dropdown messages-menu hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_accessories"></i>
              <span class="label label-info" v-if="accessoriesLoadedPartially">Partial</span>
              <span class="label label-success" v-else-if="accessoriesLoadedDate">Full</span>
              <span class="label label-danger" v-else>Loading</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="accessoriesLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ accessoriesLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadAccessories">Reload accessories</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusAccessories',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['accessories', 'accessoriesLoadedDate', 'accessoriesLoadedPartially'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveAccessories']),
      reloadAccessories () {
        this.retrieveAccessories({
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
