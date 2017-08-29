<template>
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <router-link to="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b>db</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Nendoroids</b> db</span>
    </router-link>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <app-header-loading-status-boxes></app-header-loading-status-boxes>
          <app-header-loading-status-nendoroids></app-header-loading-status-nendoroids>
          <app-header-loading-status-faces></app-header-loading-status-faces>
          <app-header-loading-status-hairs></app-header-loading-status-hairs>
          <app-header-loading-status-hands></app-header-loading-status-hands>
          <app-header-loading-status-bodyparts></app-header-loading-status-bodyparts>
          <app-header-loading-status-accessories></app-header-loading-status-accessories>

          <app-header-messages :messages="messages" v-if="false"></app-header-messages>
          <app-header-notifications :notifications="notifications" v-if="false"></app-header-notifications>
          <app-header-tasks :tasks="tasks" v-if="false"></app-header-tasks>
          <app-header-user-panel></app-header-user-panel>

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
  import AppHeaderLoadingStatusBoxes from './HeaderLoadingStatusBoxes'
  import AppHeaderLoadingStatusNendoroids from './HeaderLoadingStatusNendoroids'
  import AppHeaderLoadingStatusFaces from './HeaderLoadingStatusFaces'
  import AppHeaderLoadingStatusHairs from './HeaderLoadingStatusHairs'
  import AppHeaderLoadingStatusHands from './HeaderLoadingStatusHands'
  import AppHeaderLoadingStatusBodyparts from './HeaderLoadingStatusBodyparts'
  import AppHeaderLoadingStatusAccessories from './HeaderLoadingStatusAccessories'
  import AppHeaderMessages from './HeaderMessages'
  import AppHeaderNotifications from './HeaderNotifications'
  import AppHeaderTasks from './HeaderTasks'
  import AppHeaderUserPanel from './HeaderUserPanel'

  export default {
    name: 'Header',
    components: {
      AppHeaderLoadingStatusBoxes,
      AppHeaderLoadingStatusNendoroids,
      AppHeaderLoadingStatusFaces,
      AppHeaderLoadingStatusHairs,
      AppHeaderLoadingStatusHands,
      AppHeaderLoadingStatusBodyparts,
      AppHeaderLoadingStatusAccessories,
      AppHeaderMessages,
      AppHeaderNotifications,
      AppHeaderTasks,
      AppHeaderUserPanel
    },
    props: ['messages', 'notifications', 'tasks'],
    data () {
      return {
      }
    }
  }
</script>
