<template>
  <div class="db-hands">
    <hands-tiles :hands="hands"></hands-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import HandsTiles from './dblayouts/HandsTiles'

export default {
  name: 'Hands',
  components: {
    HandsTiles
  },
  data () {
    return {
      resources: Resources,
      hands: []
    }
  },
  mounted () {
    this.$hands = this.$resource('hands{/id}')
    this.$hands.query().then((response) => {
      this.hands = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
