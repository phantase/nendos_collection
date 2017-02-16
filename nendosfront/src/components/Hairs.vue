<template>
  <div class="db-hairs">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-hair-internalid">{{ hair.internalid }}</div>
            </h3>
          </div>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/hairs/'+hair.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'

export default {
  name: 'Hairs',
  data () {
    return {
      resources: Resources,
      hairs: []
    }
  },
  mounted () {
    this.$hairs = this.$resource('hairs{/id}')
    this.$hairs.query().then((response) => {
      this.hairs = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
