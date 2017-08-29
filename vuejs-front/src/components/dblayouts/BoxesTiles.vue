<template>
  <div :class="norow?'':'row'">
    <router-link :to="'/box/'+box.internalid" :class="classtiles" v-for="box in boxes">

      <box-tile :box="box"></box-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import BoxTile from './BoxTile'

export default {
  name: 'BoxesTiles',
  props: ['boxes', 'tilessize', 'norow'],
  components: {
    BoxTile
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
