<template>
  <div :class="norow?'':'row'">
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
          <span class="badge bg-blue incollection" v-if="hand.collquantity">{{ hand.collquantity }}</span>
          <span v-if="viewvalidation">
            <span class="badge pull-right bg-green validationbadge" v-if="hand.validatorname">V</span>
            <span class="badge pull-right bg-red validationbadge" v-else>NV</span>
          </span>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

export default {
  name: 'HandsTiles',
  props: ['hands', 'tilessize', 'norow'],
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['viewvalidation']),
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-4 col-sm-6 col-xs-6'
      } else {
        return 'col-md-2 col-sm-4 col-xs-6'
      }
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
