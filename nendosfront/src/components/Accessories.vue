<template>
  <div class="db-accessories">
    <accessories-tiles :accessories="accessories"></accessories-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'

export default {
  name: 'Accessories',
  components: {
    AccessoriesTiles
  },
  data () {
    return {
      resources: Resources,
      accessories: []
    }
  },
  mounted () {
    this.$accessories = this.$resource('accessories{/id}')
    this.$accessories.query().then((response) => {
      this.accessories = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
