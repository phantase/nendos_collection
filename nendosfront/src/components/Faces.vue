<template>
  <div class="db-faces">
    <faces-tiles :faces="faces"></faces-tiles>
  </div>
</template>

<script>
import Resources from './../config/resources'
import FacesTiles from './dblayouts/FacesTiles'

export default {
  name: 'Faces',
  components: {
    FacesTiles
  },
  data () {
    return {
      resources: Resources,
      faces: []
    }
  },
  mounted () {
    this.$faces = this.$resource('faces{/id}')
    this.$faces.query().then((response) => {
      this.faces = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
