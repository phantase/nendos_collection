<template>
  <div class="row">
    <router-link :to="'/bodypart/'+bodypart.internalid" :class="classtiles" v-for="bodypart in bodyparts">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-bodypart-internalid">{{ bodypart.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-bodypart-part text-yellow'>`+bodypart.part+`</div>
                        <div class='db-bodypart-description'><span class='text-yellow'>Description:</span> `+bodypart.description+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/bodyparts/'+bodypart.internalid+'_thumb'" />
          <span class="badge bg-blue incollection" v-if="bodypart.collquantity">{{ bodypart.collquantity }}</span>
          <span v-if="viewvalidation">
            <span class="badge pull-right bg-green validationbadge" v-if="bodypart.validatorname">V</span>
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
  name: 'BodypartsTiles',
  props: ['bodyparts', 'tilessize'],
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
