<template>
  <div class="db-nendoroids">
    <nendoroids-tiles :nendoroids="nendoroids"></nendoroids-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import NendoroidsTiles from './dblayouts/NendoroidsTiles'

export default {
  name: 'Nendoroids',
  components: {
    NendoroidsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['nendoroids'])
  }
}
</script>

<style>
  .db-nendoroid-version {
    font-style: italic;
  }
</style>
