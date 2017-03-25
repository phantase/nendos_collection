<template>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

        <template v-for="row in menus">

          <li class="treeview" :class="row.link === pageto ? 'active' : ''" v-if="row.hasOwnProperty('link')">
            <router-link :to="row.link">
              <i :class="'fa ' + row.icon "></i>
              <span>{{ row.name }}</span>
              <span class="pull-right-container" v-if="row.hasOwnProperty('child') && typeof row.child.length != 'undefined'">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </router-link>

            <ul v-if="row.hasOwnProperty('child') && typeof row.child.length != 'undefined'" class="treeview-menu">
              <li :class="child.link === pageto ? 'active' : ''" v-for="child in row.child">
                <router-link :to="child.link">
                  <i :class="'fa ' + child.icon "></i> {{ child.name }}
                </router-link>
              </li>
            </ul>

          </li>

          <li class="header" v-else>{{ row.name }}</li>

        </template>

      </ul>
      <!-- /.sidebar-menu -->
</template>

<script>
  export default {
    name: 'SidebarMenu',
    data () {
      return {
        menus: this.$parent.$parent.$data.menus || []
      }
    },
    computed: {
      pageto () {
        return this.$route.path
      }
    }
  }
</script>
