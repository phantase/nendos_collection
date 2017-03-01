<template>
  <div class="db-hands">
    <hands-tiles :hands="hands"></hands-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import HandsTiles from './dblayouts/HandsTiles'

export default {
  name: 'Hands',
  components: {
    HandsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['hands'])
  }
}
</script>
