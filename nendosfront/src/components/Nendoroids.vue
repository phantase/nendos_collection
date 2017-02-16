<template>
  <div class="db-nendoroids">
    <nendoroids-tiles :nendoroids="nendoroids"></nendoroids-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'

export default {
  name: 'Nendoroids',
  components: {
    NendoroidsTiles
  },
  data () {
    return {
      resources: Resources,
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
  .db-nendoroid-version {
    font-style: italic;
  }
</style>
