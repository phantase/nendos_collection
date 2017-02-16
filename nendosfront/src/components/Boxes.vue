<template>
  <div class="db-boxes">
    <boxes-tiles :boxes="boxes"></boxes-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import BoxesTiles from './dblayouts/BoxesTiles'

export default {
  name: 'Boxes',
  components: {
    BoxesTiles
  },
  data () {
    return {
      resources: Resources,
      boxes: []
    }
  },
  mounted () {
    this.$boxes = this.$resource('boxes{/id}')
    this.$boxes.query().then((response) => {
      this.boxes = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>

<style>
  .db-box-category {
    font-weight: bold;
  }
  .db-box-series {
    font-style: italic;
  }
</style>
