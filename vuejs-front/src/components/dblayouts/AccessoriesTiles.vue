<template>
  <div class="row">
    <router-link :to="'/accessory/'+accessory.internalid" :class="classtiles" v-for="accessory in accessories">

    <accessory-tile :accessory="accessory"></accessory-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import AccessoryTile from './AccessoryTile'

export default {
  name: 'AccessoriesTiles',
  props: ['accessories', 'tilessize'],
  components: {
    AccessoryTile
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
