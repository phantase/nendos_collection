<template>
  <div class="row">
    <router-link :to="'/face/'+face.internalid" :class="classtiles" v-for="face in faces">

      <face-tile :face="face"></face-tile>

    </router-link>
  </div>
</template>

<script>
import store from './../../store'

import Resources from './../../config/resources'

import FaceTile from './FaceTile'

export default {
  name: 'FacesTiles',
  props: ['faces', 'tilessize'],
  components: {
    FaceTile
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
