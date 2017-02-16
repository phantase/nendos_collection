<template>
  <div class="db-hairs">
    <hairs-tiles :hairs="hairs"></hairs-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import HairsTiles from './dblayouts/HairsTiles'

export default {
  name: 'Hairs',
  components: {
    HairsTiles
  },
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
