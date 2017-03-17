<template>
      <div class="box box-solid"
            :style="collectpage?collectable?'background-color: #9e9;':'background-color: #e99;':''"
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
          <img :src="resources.apiurl+'/images/bodyparts/'+bodypart.internalid+'/thumb'" />
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
  props: ['bodypart', 'minimal', 'collectpage', 'collactivated'],
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
        this.$emit(this.collectable ? 'collect' : 'uncollect', 'bodypart', this.bodypart.internalid)
      }
    }
  },
  mounted () {
    this.$emit(this.collectable ? 'collect' : 'uncollect', 'bodypart', this.bodypart.internalid)
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
