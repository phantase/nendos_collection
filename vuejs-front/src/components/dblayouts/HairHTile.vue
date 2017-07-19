<template>
  <router-link :to="'/hair/'+hair.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_hair"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/hairs/'+hair.internalid+'/thumb'" v-if="hair.haspicture == '1'"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-number">{{ hair.frontback }}</span>
        <span class="info-box-text"><b>Haircut:</b> {{ hair.haircut }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'HairHTile',
  props: ['hair'],
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
