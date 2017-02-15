<template>
                  <li><!-- start message -->
                    <router-link :to="'/message/' + message.id ">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img :src="'/static/adminLte/img/user' + message.from.id + '-128x128.jpg'" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        {{ message.from.name }}
                        <small><i class="fa fa-clock-o"></i> {{ message.datetime }}</small>
                      </h4>
                      <!-- The message -->
                      <p>{{ message.title }}</p>
                    </router-link>
                  </li>
                  <!-- end message -->
</template>

<script>
  export default {
    name: 'HeaderMessagesSingle',
    props: ['message'],
    data () {
      return {
      }
    }
  }
</script>
