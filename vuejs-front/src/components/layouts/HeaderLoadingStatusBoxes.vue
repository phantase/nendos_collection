<template>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_boxes"></i>
              <span class="label label-success" v-if="boxesLoadedDate">Ok</span>
              <span class="label label-danger" v-else>...</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="boxesLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ boxesLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadBoxes">Reload boxes</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusBoxes',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['boxes', 'boxesLoadedDate'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveBoxes']),
      reloadBoxes () {
        this.retrieveBoxes({
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
