<template>
      <div class="box box-solid"
            :style="getStyle()"
            @click="changeCollectability">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-hair-internalid">{{ hair.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-hair-frontback text-yellow'>`+hair.frontback+`</div>
                        <div class='db-hair-haircut'><span class='text-yellow'>Haircut:</span> `+hair.haircut+`</div>
                        <div class='db-hair-description'><span class='text-yellow'>Description:</span> `+hair.description+`</div>`">
          <img :src="resources.apiurl+'/images/hairs/'+hair.internalid+'/thumb'" v-if="hair.haspicture == '1'"/>
          <img :src="resources.apiurl+'/images/unknown'" v-else />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="hair.collquantity">{{ hair.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="hair.validatorname">V</span>
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
  name: 'HairTile',
  props: ['hair', 'minimal', 'collectpage', 'uncollectpage'],
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
        this.$emit(this.collectable ? 'collect' : 'uncollect', 'hair', this.hair.internalid)
      }
      if (this.collectpage) {
        this.collectable = !this.collectable
        this.$emit(this.collectable ? 'collect' : 'dontcollect', 'hair', this.hair.internalid)
      } else if (this.uncollectpage && this.hair.collquantity) {
        this.uncollectable = !this.uncollectable
        this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'hair', this.hair.internalid)
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
        if (this.hair.collquantity === null) {
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
      this.$emit(this.collectable ? 'collect' : 'dontcollect', 'hair', this.hair.internalid)
    } else if (this.uncollectpage && this.hair.collquantity) {
      this.$emit(this.uncollectable ? 'uncollect' : 'keep', 'hair', this.hair.internalid)
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
