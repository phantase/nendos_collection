<template>
  <div class="db-faces">
    <faces-tiles :faces="faces"></faces-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import FacesTiles from './dblayouts/FacesTiles'

export default {
  name: 'Faces',
  components: {
    FacesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['faces'])
  }
}
</script>
