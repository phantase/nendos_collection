<template>
  <div class="row">
    <router-link :to="'/hand/'+hand.internalid" :class="classtiles" v-for="hand in hands">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-hand-internalid">{{ hand.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-hand-leftright text-yellow'>`+hand.leftright+`</div>
                        <div class='db-hand-posture'><span class='text-yellow'>Posture:</span> `+hand.posture+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/hands/'+hand.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'HandsTiles',
  props: ['hands', 'tilessize'],
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
