<template>
  <router-link :to="'/face/'+face.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_face"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/faces/'+face.internalid+'/1/thumb'" v-if="face.nbpictures > 0"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-text"><b>Eyes:</b> {{ face.eyes }}</span>
        <span class="info-box-text"><b>Mouth:</b> {{ face.mouth }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'FaceHTile',
  props: ['face'],
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
