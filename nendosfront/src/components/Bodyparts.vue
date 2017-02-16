<template>
  <div class="db-bodyparts">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodyparts">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-bodypart-internalid">{{ bodypart.internalid }}</div>
            </h3>
          </div>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/bodyparts/'+bodypart.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'

export default {
  name: 'Bodyparts',
  data () {
    return {
      resources: Resources,
      bodyparts: []
    }
  },
  mounted () {
    this.$bodyparts = this.$resource('bodyparts{/id}')
    this.$bodyparts.query().then((response) => {
      this.bodyparts = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
