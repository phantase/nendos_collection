<template>
  <div class="photos">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12" v-for="photo in photos">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="photo-title">{{ photo.title }}</div>
              <div class="photo-username">by {{ photo.username }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/photos/'+photo.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Photos',
  data () {
    return {
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
  .photo-title {
    font-weight: bold;
  }
  .photo-username {
    font-style: italic;
  }
</style>
