<template>
  <div class="db-boxes">
    <boxes-tiles :boxes="boxes"></boxes-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import BoxesTiles from './dblayouts/BoxesTiles'

export default {
  name: 'Boxes',
  components: {
    BoxesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes'])
  },
  methods: {
    ...Vuex.mapActions(['retrieveBoxes'])
  },
  mounted () {
    this.retrieveBoxes({'context': this})
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
