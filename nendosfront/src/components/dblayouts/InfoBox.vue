<template>
              <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon" :class="color"><i class="fa" :class="icon"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">{{ title }}</span>
                  <span class="info-box-number"><span v-if="usercount">{{ usercount }} / </span>{{ count }}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
</template>

<script>
  export default {
    name: 'InfoBox',
    props: ['color', 'icon', 'title', 'count', 'usercount'],
    data () {
      return {
      }
    }
  }
</script>
