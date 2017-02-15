<template>
  <div class="hairs">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="hair-internalid">{{ hair.internalid }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/hairs/'+hair.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Hairs',
  data () {
    return {
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
