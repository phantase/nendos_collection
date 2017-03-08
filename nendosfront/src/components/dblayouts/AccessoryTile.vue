<template>
      <div class="box box-solid"
            :style="collectpage?accessory.collquantity?'background-color: #ddd;':collectable?'background-color: #9e9;':'background-color: #e99;':''"
            @click="changeCollectability">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-accessory-internalid">{{ accessory.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-accessory-type text-yellow'>`+accessory.type+`</div>
                        <div class='db-accessory-description'><span class='text-yellow'>Description:</span> `+accessory.description+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/accessories/'+accessory.internalid+'_thumb'" />
          <span v-if="!minimal">
            <span class="badge bg-blue incollection" v-if="accessory.collquantity">{{ accessory.collquantity }}</span>
            <span v-if="viewvalidation">
              <span class="badge pull-right bg-green validationbadge" v-if="accessory.validatorname">V</span>
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
  name: 'AccessoryTile',
  props: ['accessory', 'minimal', 'collectpage'],
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
      this.collectable = !this.collectable
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
