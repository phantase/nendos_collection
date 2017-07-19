<template>
  <router-link :to="'/accessory/'+accessory.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_accessories"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/accessories/'+accessory.internalid+'/thumb'" v-if="accessory.haspicture == '1'"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-number">{{ accessory.type }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'AccessoryHTile',
  props: ['accessory'],
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
