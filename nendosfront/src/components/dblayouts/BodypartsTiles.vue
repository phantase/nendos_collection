<template>
  <div class="row">
    <div :class="classtiles" v-for="bodypart in bodyparts">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-bodypart-internalid">{{ bodypart.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/bodyparts/'+bodypart.internalid+'_thumb'" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'BodypartsTiles',
  props: ['bodyparts', 'tilessize'],
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
