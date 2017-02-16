<template>
  <div class="db-bodyparts">
    <bodyparts-tiles :bodyparts="bodyparts"></bodyparts-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import BodypartsTiles from './dblayouts/BodypartsTiles'

export default {
  name: 'Bodyparts',
  components: {
    BodypartsTiles
  },
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
