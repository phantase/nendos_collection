<template>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

        <template v-for="row in menus">

          <router-link tag="li" active-class="active" :to="row.link" class="treeview" v-if="row.hasOwnProperty('link')">
            <a>
              <i :class="'fa ' + row.icon "></i>
              <span>{{ row.name }}</span>
            </a>

            <ul v-show="row.hasOwnProperty('child') && typeof row.child.length != 'undefined'" class="treeview-menu">
              <router-link tag="li" active-class="active" :to="child.link" v-for="child in row.child">
                <a>
                  <i :class="'fa ' + child.icon "></i> {{ child.name }}
                </a>
              </router-link>
            </ul>

          </router-link>

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
    }
  }
</script>
