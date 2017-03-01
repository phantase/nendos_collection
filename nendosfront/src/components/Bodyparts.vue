<template>
  <div class="db-bodyparts">
    <bodyparts-tiles :bodyparts="bodyparts"></bodyparts-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import BodypartsTiles from './dblayouts/BodypartsTiles'

export default {
  name: 'Bodyparts',
  components: {
    BodypartsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['bodyparts'])
  }
}
</script>
