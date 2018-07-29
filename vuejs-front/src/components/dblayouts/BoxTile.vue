<template>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-box-category text-yellow" data-toggle="tooltip" :title="box.category+(box.number?' #'+box.number:'')">
              <span>{{ box.category}}</span>
              <span v-if="box.number">#{{ box.number}}</span>
            </div>
            <div class="db-box-name" data-toggle="tooltip" :title="box.name">{{ box.name }}</div>
            <div class="db-box-series" data-toggle="tooltip" :title="box.series">{{ box.series ? box.series : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-box-category text-yellow'>`+box.category+(box.number ? ' #'+box.number:'')+`</div>
                            <div class='db-box-name'>`+box.name+`</div>
                            <div class='db-box-series'>`+(box.series?box.series:``)+`</div>`">
          <img :src="resources.img_url+'/images/boxes/'+box.internalid+'/1/thumb'" v-if="box.nbpictures > 0"/>
          <img :src="resources.img_url+'/images/unknown'" v-else />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="box.collquantity">{{ box.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="box.validatorname">V</span>
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
  name: 'BoxTile',
  props: ['box', 'minimal'],
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
  updated () {
    $('[data-toggle="tooltip"]').tooltip('fixTitle')
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
