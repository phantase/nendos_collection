<template>
      <div class="box box-solid"
            :style="getStyle()"
            @click="changeCollectability">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-nendoroid-name" data-toggle="tooltip" :title="nendoroid.name">{{ nendoroid.name }}</div>
            <div class="db-nendoroid-version" data-toggle="tooltip" :title="nendoroid.version" v-if="!minimal">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-nendoroid-name'>`+nendoroid.name+`</div>
                        <div class='db-nendoroid-version'>`+(nendoroid.version ? nendoroid.version : '')+`</div>`">
          <img :src="resources.apiurl+'/images/nendoroids/'+nendoroid.internalid+'/thumb'" />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="nendoroid.collquantity">{{ nendoroid.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="nendoroid.validatorname">V</span>
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
  name: 'NendoroidTile',
  props: ['nendoroid', 'minimal', 'collectpage', 'uncollectpage'],
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
        this.$emit(this.collectable ? 'collect' : 'dontcollect', 'nendoroid', this.nendoroid.internalid)
      } else if (this.uncollectpage && this.nendoroid.collquantity) {
        this.uncollectable = !this.uncollectable
        this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'nendoroid', this.nendoroid.internalid)
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
        if (this.nendoroid.collquantity === null) {
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
      this.$emit(this.collectable ? 'collect' : 'dontcollect', 'nendoroid', this.nendoroid.internalid)
    } else if (this.uncollectpage && this.nendoroid.collquantity) {
      this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'nendoroid', this.nendoroid.internalid)
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
