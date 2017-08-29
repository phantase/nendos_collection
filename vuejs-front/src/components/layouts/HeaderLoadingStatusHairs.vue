<template>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_hair"></i>
              <span class="label label-info" v-if="hairsLoadedPartially">Partial</span>
              <span class="label label-success" v-else-if="hairsLoadedDate">Full</span>
              <span class="label label-danger" v-else>Loading</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="hairsLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ hairsLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadHairs">Reload hairs</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusHairs',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['hairs', 'hairsLoadedDate', 'hairsLoadedPartially'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveHairs']),
      reloadHairs () {
        this.retrieveHairs({
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
