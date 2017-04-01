<template>
  <div class="row">
    <router-link :to="'/hair/'+hair.internalid" :class="classtiles" v-for="hair in hairs">

      <hair-tile :hair="hair"></hair-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

import HairTile from './HairTile'

export default {
  name: 'HairsTiles',
  props: ['hairs', 'tilessize'],
  components: {
    HairTile
  },
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
