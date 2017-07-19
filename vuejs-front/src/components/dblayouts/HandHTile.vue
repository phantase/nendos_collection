<template>
  <router-link :to="'/hand/'+hand.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_hand"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/hands/'+hand.internalid+'/thumb'" v-if="hand.haspicture == '1'"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-number">{{ hand.leftright }}</span>
        <span class="info-box-text"><b>Posture:</b> {{ hand.posture }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'HandHTile',
  props: ['hand'],
  data () {
    return {
      resources: Resources
    }
  }
}
</script>

<style scoped>
img {
  vertical-align: baseline;
}
a {
  color: black;
}
</style>
