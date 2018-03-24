<template>
  <div class="row">
    <router-link :to="'/bodypart/'+bodypart.internalid" :class="classtiles" v-for="bodypart in bodyparts" :key="bodypart.internalid">

      <bodypart-tile :bodypart="bodypart"></bodypart-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import BodypartTile from './BodypartTile'

export default {
  name: 'BodypartsTiles',
  props: ['bodyparts', 'tilessize'],
  components: {
    BodypartTile
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
