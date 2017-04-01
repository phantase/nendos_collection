<template>
  <div class="db-accessories">
    <accessories-tiles :accessories="accessories"></accessories-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AccessoriesTiles from './dblayouts/AccessoriesTiles'

export default {
  name: 'Accessories',
  components: {
    AccessoriesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['accessories'])
  }
}
</script>
