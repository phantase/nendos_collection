<template>
  <router-link :to="'/nendoroid/'+nendoroid.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_nendo"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/nendoroids/'+nendoroid.internalid+'/1/thumb'" v-if="nendoroid.nbpictures > 0"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-number">{{ nendoroid.name }}</span>
        <span class="info-box-text">{{ nendoroid.version }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'NendoroidHTile',
  props: ['nendoroid'],
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
