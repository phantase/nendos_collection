<template>
      <div class="box box-solid" :id="'db-photo-'+photo.internalid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-photo-title">{{ photo.title }}</div>
            <div class="db-photo-username">by {{ photo.username }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.img_url+'/images/photos/'+photo.internalid+'/thumb'" />
        </div>
      </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'PhotoTile',
  props: ['photo'],
  data () {
    return {
      resources: Resources
    }
  },
  updated () {
    $('[data-toggle="tooltip"]').tooltip('fixTitle')
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
