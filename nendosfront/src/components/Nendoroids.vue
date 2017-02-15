<template>
  <div class="nendoroids">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12" v-for="nendoroid in nendoroids">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="nendoroid-name">{{ nendoroid.name }}</div>
              <div class="nendoroid-version">{{ nendoroid.version }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  name: 'Nendoroids',
  data () {
    return {
      nendoroids: []
    }
  },
  mounted () {
    this.$nendoroids = this.$resource('nendoroids{/id}')
    this.$nendoroids.query().then((response) => {
      this.nendoroids = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>

<style>
  .nendoroid-version {
    font-style: italic;
  }
</style>
