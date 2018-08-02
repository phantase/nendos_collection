<template>
  <router-link :to="'/bodypart/'+bodypart.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_body"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/bodyparts/'+bodypart.internalid+'/1/thumb'" v-if="bodypart.nbpictures > 0"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-number">{{ bodypart.part }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'BodypartHTile',
  props: ['bodypart'],
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
