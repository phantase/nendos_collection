<template>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{ messages.length }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ messages.length }} message{{ messages.length > 1 ? 's' : '' }}</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">

                  <app-header-messages-single v-for="message in messages" :key="message.id" :message="message" ></app-header-messages-single>

                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer">
                <router-link to="/messages">See All Messages</router-link>
              </li>
            </ul>
          </li>
          <!-- /.messages-menu -->
</template>

<script>
  import AppHeaderMessagesSingle from './HeaderMessagesSingle'

  export default {
    name: 'HeaderMessages',
    components: {
      AppHeaderMessagesSingle
    },
    props: ['messages'],
    data () {
      return {
      }
    }
  }
</script>
