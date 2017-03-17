<template>
      <div class="box box-solid"
            :style="collectpage?collectable?'background-color: #9e9;':'background-color: #e99;':''"
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
  props: ['nendoroid', 'minimal', 'collectpage', 'collactivated'],
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
        this.$emit(this.collectable ? 'collect' : 'uncollect', 'nendoroid', this.nendoroid.internalid)
      }
    }
  },
  mounted () {
    this.$emit(this.collectable ? 'collect' : 'uncollect', 'nendoroid', this.nendoroid.internalid)
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
