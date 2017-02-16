<template>
  <div class="db-photos">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12" v-for="photo in photos">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db(photo-title">{{ photo.title }}</div>
              <div class="db-photo-username">by {{ photo.username }}</div>
            </h3>
          </div>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/photos/'+photo.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'

export default {
  name: 'Photos',
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
