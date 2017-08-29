<template>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa icon-icon_nendo_hand"></i>
              <span class="label label-success" v-if="handsLoadedDate">Ok</span>
              <span class="label label-danger" v-else>...</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" v-if="handsLoadedDate"><i class="icon fa fa-clock-o"></i> Loaded on {{ handsLoadedDate }}</li>
              <li class="header" v-else>Not loaded</li>
              <li>
                <ul class="menu">
                </ul>
              </li>
              <li class="footer">
                <a @click="reloadHands">Reload hands</a>
              </li>
            </ul>
          </li>
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'HeaderLoadingStatusHands',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['hands', 'handsLoadedDate'])
    },
    methods: {
      ...Vuex.mapActions(['retrieveHands']),
      reloadHands () {
        this.retrieveHands({
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
