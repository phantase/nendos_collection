<template>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <app-sidebar-user-panel></app-sidebar-user-panel>

      <app-sidebar-search-form></app-sidebar-search-form>

      <app-sidebar-menu></app-sidebar-menu>

    </section>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
  import AppSidebarUserPanel from './SidebarUserPanel'
  import AppSidebarSearchForm from './SidebarSearchForm'
  import AppSidebarMenu from './SidebarMenu'

  export default {
    name: 'Sidebar',
    components: {
      AppSidebarUserPanel,
      AppSidebarSearchForm,
      AppSidebarMenu
    },
    data () {
      return {
      }
    }
  }
</script>
