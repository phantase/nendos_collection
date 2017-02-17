<template>
  <div class="row">
    <router-link :to="'/hair/'+hair.internalid" :class="classtiles" v-for="hair in hairs">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-hair-internalid">{{ hair.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/hairs/'+hair.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'HairsTiles',
  props: ['hairs', 'tilessize'],
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-4 col-sm-6 col-xs-6'
      } else {
        return 'col-md-2 col-sm-4 col-xs-6'
      }
    }
  }
}

</script>
