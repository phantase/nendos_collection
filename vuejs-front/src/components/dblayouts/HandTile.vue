<template>
      <div class="box box-solid"
            :style="getStyle()"
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
          <img :src="resources.apiurl+'/images/hands/'+hand.internalid+'/thumb'" />
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
  props: ['hand', 'minimal', 'collectpage', 'uncollectpage'],
  store: store,
  data () {
    return {
      resources: Resources,
      collectable: true,
      uncollectable: true
    }
  },
  computed: {
    ...Vuex.mapGetters(['viewvalidation'])
  },
  methods: {
    changeCollectability () {
      if (this.collectpage) {
        this.collectable = !this.collectable
        this.$emit(this.collectable ? 'collect' : 'dontcollect', 'hand', this.hand.internalid)
      } else if (this.uncollectpage && this.hand.collquantity) {
        this.uncollectable = !this.uncollectable
        this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'hand', this.hand.internalid)
      }
    },
    getStyle () {
      if (this.collectpage) {
        if (this.collectable) {
          return 'background-color: #9e9;'
        } else {
          return 'background-color: #e99;'
        }
      } else if (this.uncollectpage) {
        if (this.hand.collquantity === null) {
          return 'background-color: #ccc;'
        } else if (this.uncollectable) {
          return 'background-color: #e99;'
        } else {
          return 'background-color: #9e9;'
        }
      } else {
        return ''
      }
    }
  },
  mounted () {
    if (this.collectpage) {
      this.$emit(this.collectable ? 'collect' : 'dontcollect', 'hand', this.hand.internalid)
    } else if (this.uncollectpage && this.hand.collquantity) {
      this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'hand', this.hand.internalid)
    }
  },
  updated () {
    $('[data-toggle="tooltip"]').tooltip('fixTitle')
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
