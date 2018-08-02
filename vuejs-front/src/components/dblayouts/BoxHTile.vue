<template>
  <router-link :to="'/box/'+box.internalid">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa icon-icon_nendo_boxes"></i></span>
      <span class="info-box-icon bg-yellow" style="float:right;">
        <img :src="resources.img_url+'/images/boxes/'+box.internalid+'/1/thumb'" v-if="box.nbpictures > 0"/>
        <img :src="resources.img_url+'/images/unknown'" v-else />
      </span>
      <div class="info-box-content">
        <span class="info-box-text">
          <span>{{ box.category}}</span>
          <span v-if="box.number">#{{ box.number}}</span>
        </span>
        <span class="info-box-number">{{ box.name }}</span>
        <span class="info-box-text">{{ box.series }}</span>
      </div>
    </div>
  </router-link>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'BoxHTile',
  props: ['box'],
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
