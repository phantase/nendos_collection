<template>
                  <li><!-- start notification -->
                    <router-link :to="'/notification/' + notification.id">
                      <i class="fa" :class="notification.icon + ' ' + notification.color"></i> {{ notification.message }}
                    </router-link>
                  </li>
                  <!-- end notification -->
</template>

<script>
  export default {
    name: 'HeaderNotificationsSingle',
    props: ['notification'],
    data () {
      return {
      }
    }
  }
</script>
