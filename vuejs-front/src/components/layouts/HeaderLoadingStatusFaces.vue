<template>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_face"></i>
              <span class="label label-success" v-if="facesLoadedDate">Ok</span>
              <span class="label label-danger" v-else>...</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="facesLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ facesLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadFaces">Reload faces</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusFaces',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['faces', 'facesLoadedDate'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveFaces']),
      reloadFaces () {
        this.retrieveFaces({
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
