<template>
  <div class="wrapper">
    <app-header :messages="messages" :notifications="notifications" :tasks="tasks"></app-header>
    <app-sidebar></app-sidebar>
    <app-content></app-content>
    <app-footer></app-footer>
    <app-control-sidebar></app-control-sidebar>
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
</template>

<script>
import AppHeader from './components/layouts/Header'
import AppSidebar from './components/layouts/Sidebar'
import AppContent from './components/layouts/Content'
import AppFooter from './components/layouts/Footer'
import AppControlSidebar from './components/layouts/ControlSidebar'

import store from './store'
import Vuex from 'vuex'

import Menus from './config/menus'

export default {
  name: 'app',
  store: store,
  components: {
    AppHeader,
    AppSidebar,
    AppContent,
    AppFooter,
    AppControlSidebar
  },
  data () {
    return {
      menus: Menus,
      messages: [],
      notifications: [],
      tasks: []
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated'])
  },
  methods: {
    ...Vuex.mapActions(['relogin', 'retrieveData'])
  },
  mounted () {
    this.relogin({
      'context': this
    }).then(() => {
      console.log('Successfully reconnected')
      this.retrieveData({'context': this})
    }, () => {
      console.log('Not connected')
      this.retrieveData({'context': this})
    })
  }
}
</script>

<style src="../static/icomoon/style.css"></style>

<style>
  .box:hover, .info-box:hover {
    box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.3);
  }
  .box-title {
    width: calc(100%);
  }
  .box-title div {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .db-image {
    position: relative;
    overflow: hidden;
    padding-bottom: 100%;
  }
  .db-image img{
    position: absolute;
    max-width: calc(100% - 20px);
    max-height: calc(100% - 20px);
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.3);
  }
  .incollection {
    position: absolute;
    top: 5px;
    left: 5px;
  }
  .validationbadge {
    position: absolute;
    top: 5px;
    right: 5px;
  }
</style>
