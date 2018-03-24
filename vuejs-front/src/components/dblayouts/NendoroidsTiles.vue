<template>
  <div class="row">
    <router-link :to="'/nendoroid/'+nendoroid.internalid" :class="classtiles" v-for="nendoroid in nendoroids" :key="nendoroid.internalid">

      <nendoroid-tile :nendoroid="nendoroid"></nendoroid-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import NendoroidTile from './NendoroidTile'

export default {
  name: 'NendoroidsTiles',
  props: ['nendoroids', 'tilessize'],
  components: {
    NendoroidTile
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
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
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
