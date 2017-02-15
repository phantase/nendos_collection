<template>
              <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon" :class="info.color"><i class="fa" :class="info.icon"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">{{ info.title }}</span>
                  <span class="info-box-number">{{ info.message }}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
</template>

<script>
  export default {
    name: 'InfoBox',
    props: ['info'],
    data () {
      return {
      }
    }
  }
</script>
