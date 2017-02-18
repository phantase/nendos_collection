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

import Menus from './config/menus'

export default {
  name: 'app',
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
      messages: [
        {
          id: '1',
          from: {
            id: '2',
            name: 'Support Team'
          },
          title: 'Why not buy a new awesome theme?',
          datetime: '5 mins'
        },
        {
          id: '42',
          from: {
            id: '42',
            name: 'Marvin'
          },
          title: 'Read the Hitchhiker\'s Guide to the Galaxy!',
          datetime: '42 mins'
        }
      ],
      notifications: [
        {
          id: '12',
          message: 'Today, it\'s snowy',
          icon: 'snowflake-o',
          color: 'text-aqua'
        },
        {
          id: '13',
          message: 'Tomorrow, it will be sunny',
          icon: 'fa-sun-o',
          color: 'text-yellow'
        },
        {
          id: '14',
          message: 'Yesterday, it was cloudy',
          icon: 'fa-cloud'
        }
      ],
      tasks: [
        {
          id: '99',
          title: 'Read some books',
          percent: 70
        },
        {
          id: '100',
          title: 'Listen some musics',
          percent: 90
        },
        {
          id: '101',
          title: 'Watch some movies',
          percent: 10
        },
        {
          id: '102',
          title: 'Play some video games',
          percent: 0
        }
      ]
    }
  }
}
</script>

<style src="../static/bootstrap/css/bootstrap.min.css"></style>
<style src="../static/adminLte/css/skins/_all-skins.min.css"></style>
<style src="../static/adminLte/css/AdminLTE.min.css"></style>
<style src="../static/icomoon/style.css"></style>

<style>
  .box-title {
    width: calc(100%);
  }
  .box-title div {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .db-image img {
    width: 100%;
  }
</style>
