<template>
  <div class="db-photos">
    <photos-tiles :photos="photos"></photos-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Photos',
  components: {
    PhotosTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['photos'])
  }
}
</script>

<style>
  .db-photo-title {
    font-weight: bold;
  }
  .db-photo-username {
    font-style: italic;
  }
</style>
