<template>
  <div class="db-hairs">
    <hairs-tiles :hairs="hairs"></hairs-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import HairsTiles from './dblayouts/HairsTiles'

export default {
  name: 'Hairs',
  components: {
    HairsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['hairs'])
  }
}
</script>
