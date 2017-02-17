<template>
  <div class="row">
    <router-link :to="'/photo/'+photo.internalid" :class="classtiles" v-for="photo in photos">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-photo-title">{{ photo.title }}</div>
            <div class="db-photo-username">by {{ photo.username }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/photos/'+photo.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'PhotosTiles',
  props: ['photos', 'tilessize'],
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
  }
}

</script>
