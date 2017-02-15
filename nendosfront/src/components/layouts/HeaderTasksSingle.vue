<template>
                  <li><!-- Task item -->
                    <router-link :to="'/task/' + task.id">
                      <!-- Task title and progress text -->
                      <h3>
                        {{ task.title }}
                        <small class="pull-right">{{ task.percent }}%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-yellow" :style="'width: ' + task.percent + '%'" role="progressbar" :aria-valuenow="task.percent" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">{{ task.percent }}% Complete</span>
                        </div>
                      </div>
                    </router-link>
                  </li>
                  <!-- end task item -->
</template>

<script>
  export default {
    name: 'HeaderTasksSingle',
    props: ['task'],
    data () {
      return {
      }
    }
  }
</script>
