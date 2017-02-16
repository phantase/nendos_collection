<template>
  <div class="db-photos">
    <photos-tiles :photos="photos"></photos-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Photos',
  components: {
    PhotosTiles
  },
  data () {
    return {
      resources: Resources,
      photos: []
    }
  },
  mounted () {
    this.$photos = this.$resource('photos{/id}')
    this.$photos.query().then((response) => {
      this.photos = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>

<style>
  .db-photo-title {
    font-weight: bold;
  }
  .db-photo-username {
    font-style: italic;
  }
</style>
