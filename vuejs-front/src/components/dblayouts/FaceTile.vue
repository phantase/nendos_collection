<template>
      <div class="box box-solid"
            :style="getStyle()"
            @click="changeCollectability">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-face-internalid">{{ face.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-face-eyes'><span class='text-yellow'>Eyes:</span> `+face.eyes+`</div>
                        <div class='db-face-mouth'><span class='text-yellow'>Mouth:</span> `+face.mouth+`</div>`">
          <img :src="resources.img_url+'/images/faces/'+face.internalid+'/1/thumb'" v-if="face.nbpictures > 0"/>
          <img :src="resources.img_url+'/images/unknown'" v-else />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="face.collquantity">{{ face.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="face.validatorname">V</span>
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
  name: 'FaceTile',
  props: ['face', 'minimal', 'collectpage', 'uncollectpage'],
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
        this.$emit(this.collectable ? 'collect' : 'dontcollect', 'face', this.face.internalid)
      } else if (this.uncollectpage && this.face.collquantity) {
        this.uncollectable = !this.uncollectable
        this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'face', this.face.internalid)
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
        if (this.face.collquantity === null) {
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
      this.$emit(this.collectable ? 'collect' : 'dontcollect', 'face', this.face.internalid)
    } else if (this.uncollectpage && this.face.collquantity) {
      this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'face', this.face.internalid)
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
