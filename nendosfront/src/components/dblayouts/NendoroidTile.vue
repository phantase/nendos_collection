<template>
      <div class="box box-solid"
            :style="collectpage?nendoroid.collquantity?'background-color: #ddd;':collectable?'background-color: #9e9;':'background-color: #e99;':''"
            @click.stop="changeCollectability">
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
          <img :src="resources.imagesurl+'/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
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
  props: ['nendoroid', 'minimal', 'collectpage'],
  store: store,
  data () {
    return {
      resources: Resources,
      collectable: true
    }
  },
  computed: {
    ...Vuex.mapGetters(['viewvalidation']),
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-6 col-sm-6 col-xs-12'
      } else if (typeof this.tilessize !== 'undefined' && this.tilessize === 'small') {
        return 'col-md-2 col-sm-4 col-xs-6'
      } else {
        return 'col-md-3 col-sm-6 col-xs-12'
      }
    }
  },
  methods: {
    changeCollectability () {
      this.collectable = !this.collectable
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
