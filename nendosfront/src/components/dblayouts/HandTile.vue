<template>
      <div class="box box-solid"
            :style="collectpage?collectable?'background-color: #9e9;':'background-color: #e99;':''"
            @click="changeCollectability">
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
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="hand.collquantity">{{ hand.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="hand.validatorname">V</span>
              <span class="badge pull-right bg-red validationbadge" v-else>NV</span>
            </span>
          </span>
        </div>
      </div>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

export default {
  name: 'HandsTiles',
  props: ['hand', 'minimal', 'collectpage', 'collactivated'],
  store: store,
  data () {
    return {
      resources: Resources,
      collectable: true
    }
  },
  computed: {
    ...Vuex.mapGetters(['viewvalidation'])
  },
  methods: {
    changeCollectability () {
      if (this.collactivated) {
        this.collectable = !this.collectable
        this.$emit(this.collectable ? 'collect' : 'uncollect', 'hand', this.hand.internalid)
      }
    }
  },
  mounted () {
    this.$emit(this.collectable ? 'collect' : 'uncollect', 'hand', this.hand.internalid)
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
