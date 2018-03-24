<template>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">{{ tasks.length }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ tasks.length }} task{{ tasks.length > 1 ? 's' : '' }}</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">

                  <app-header-tasks-single v-for="task in tasks" :key="task.id" :task="task"></app-header-tasks-single>

                </ul>
              </li>
              <li class="footer">
                <router-link to="/tasks">View all tasks</router-link>
              </li>
            </ul>
          </li>
</template>

<script>
  import AppHeaderTasksSingle from './HeaderTasksSingle'

  export default {
    name: 'HeaderTasks',
    components: {
      AppHeaderTasksSingle
    },
    props: ['tasks'],
    data () {
      return {
      }
    }
  }
</script>
