<template>
  <div class="db-photos">
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="Sorting and filtering" collapsable="true" collapsed="true" icon="fa-filter"></app-box-header>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="pull-right">
                  <label>Sort by: </label>
                  <select v-model="orderedby">
                    <optgroup label="Photo">
                      <option value="title">Title</option>
                      <option value="username">Author</option>
                      <option value="uploaded">Uploaded</option>
                    </optgroup>
                  </select>
                  <select v-model="direction">
                    <option value="asc">Asc</option>
                    <option value="desc">Desc</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <photos-tiles :photos="displayedPhotos"></photos-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Photos',
  components: {
    AppBoxHeader,
    PhotosTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'uploaded',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['photos']),
    displayedPhotos () {
      return this.photos.concat().sort(this.sortPhotos)
    }
  },
  methods: {
    sortPhotos (a, b) {
      if (a[this.orderedby] > b[this.orderedby]) {
        return this.direction === 'desc' ? -1 : 1
      } else {
        return this.direction === 'desc' ? 1 : -1
      }
    }
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
