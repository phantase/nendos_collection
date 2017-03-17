<template>
      <div class="box box-solid"
            :style="collectpage?collectable?'background-color: #9e9;':'background-color: #e99;':''"
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
          <img :src="resources.apiurl+'/images/faces/'+face.internalid+'/thumb'" />
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
  props: ['face', 'minimal', 'collectpage', 'collactivated'],
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
        this.$emit(this.collectable ? 'collect' : 'uncollect', 'face', this.face.internalid)
      }
    }
  },
  mounted () {
    this.$emit(this.collectable ? 'collect' : 'uncollect', 'face', this.face.internalid)
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
