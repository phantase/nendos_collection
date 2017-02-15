<template>
          <!-- Apply any bg-* class to to the info-box to color it -->
          <div class="info-box" :class="info.color">
            <span class="info-box-icon"><i class="fa" :class="info.icon"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">{{info.title}}</span>
              <span class="info-box-number">{{info.message}}</span>
              <!-- The progress section is optional -->
              <div class="progress" v-if="info.progress">
                <div class="progress-bar" :style="'width: ' + info.progress.percent + '%'"></div>
              </div>
              <span class="progress-description" v-if="info.progress">
                {{ info.progress.description }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
</template>

<script>
  export default {
    name: 'InfoBox2',
    props: ['info'],
    data() {
      return {
      };
    },
  };
</script>
