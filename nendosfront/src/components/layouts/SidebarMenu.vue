<template>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

        <template v-for="row in menus">

          <li class="treeview" :class="row.link === pageto ? 'active' : ''" v-if="row.hasOwnProperty('link')">
            <router-link :to="row.link">
              <i :class="'fa ' + row.icon "></i>
              <span>{{ row.name }}</span>
              <span class="pull-right-container" v-if="hasAllowedChild(row)">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </router-link>

            <ul v-if="hasAllowedChild(row)" class="treeview-menu">
              <li :class="child.link === pageto ? 'active' : ''" v-for="child in row.child" v-if="isAllowed(child)">
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
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'SidebarMenu',
    store: store,
    data () {
      return {
        menus: this.$parent.$parent.$data.menus || []
      }
    },
    computed: {
      ...Vuex.mapGetters(['authenticated', 'canedit']),
      pageto () {
        return this.$route.path
      }
    },
    methods: {
      hasAllowedChild (row) {
        if (row.hasOwnProperty('child') && typeof row.child.length !== 'undefined') {
          for (let child of row.child) {
            if (this.isAllowed(child)) {
              return true
            }
          }
        }
        return false
      },
      isAllowed (row) {
        if (row.hasOwnProperty('require')) {
          switch (row.require) {
            case 'authenticated':
              return this.authenticated
            case 'editor':
              return this.canedit
            default:
              return false
          }
        } else {
          return true
        }
      }
    }
  }
</script>
