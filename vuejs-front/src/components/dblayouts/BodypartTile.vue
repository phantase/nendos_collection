<template>
      <div class="box box-solid"
            :style="getStyle()"
            @click="changeCollectability">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-bodypart-internalid">{{ bodypart.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-bodypart-part text-yellow'>`+bodypart.part+`</div>
                        <div class='db-bodypart-description'><span class='text-yellow'>Description:</span> `+bodypart.description+`</div>`">
          <img :src="resources.apiurl+'/images/bodyparts/'+bodypart.internalid+'/thumb'" v-if="bodypart.haspicture == '1'"/>
          <img :src="resources.apiurl+'/images/unknown'" v-else />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="bodypart.collquantity">{{ bodypart.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="bodypart.validatorname">V</span>
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
  name: 'BodypartTile',
  props: ['bodypart', 'minimal', 'collectpage', 'uncollectpage'],
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
        this.$emit(this.collectable ? 'collect' : 'dontcollect', 'bodypart', this.bodypart.internalid)
      } else if (this.uncollectpage && this.bodypart.collquantity) {
        this.uncollectable = !this.uncollectable
        this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'bodypart', this.bodypart.internalid)
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
        if (this.bodypart.collquantity === null) {
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
      this.$emit(this.collectable ? 'collect' : 'dontcollect', 'bodypart', this.bodypart.internalid)
    } else if (this.uncollectpage && this.bodypart.collquantity) {
      this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'bodypart', this.bodypart.internalid)
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
