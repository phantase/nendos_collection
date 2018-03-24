<template>
  <div class="row">
    <router-link :to="'/photo/'+photo.internalid" :class="classtiles" v-for="photo in photos" :key="photo.internalid">

    <photo-tile :photo="photo"></photo-tile>

    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

import PhotoTile from './PhotoTile'

export default {
  name: 'PhotosTiles',
  props: ['photos', 'tilessize'],
  components: {
    PhotoTile
  },
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-6 col-sm-12 col-xs-12'
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

<style scoped>
  .db-image img{
    box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
  }
</style>
