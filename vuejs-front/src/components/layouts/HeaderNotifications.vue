<template>
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{ notifications.length }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ notifications.length }} notification{{ notifications.length > 1 ? 's' : '' }}</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">

                  <app-header-notifications-single v-for="notification in notifications" :notification="notification"></app-header-notifications-single>

                </ul>
              </li>
              <li class="footer">
                <router-link to="/notifications">View all</router-link>
              </li>
            </ul>
          </li>
</template>

<script>
  import AppHeaderNotificationsSingle from './HeaderNotificationsSingle'

  export default {
    name: 'HeaderNotification',
    components: {
      AppHeaderNotificationsSingle
    },
    props: ['notifications'],
    data () {
      return {
      }
    }
  }
</script>
