<template>
  <div class="row">
    <router-link :to="'/hand/'+hand.internalid" :class="classtiles" v-for="hand in hands" :key="hand.internalid">

      <hand-tile :hand="hand"></hand-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import HandTile from './HandTile'

export default {
  name: 'HandsTiles',
  props: ['hands', 'tilessize'],
  components: {
    HandTile
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
