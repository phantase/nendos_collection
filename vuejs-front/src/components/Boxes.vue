<template>
  <div class="db-boxes">
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
                    <optgroup label="Box">
                      <option value="number">Number</option>
                      <option value="name">Name</option>
                      <option value="series">Series</option>
                      <option value="manufacturer">Manufacturer</option>
                      <option value="category">Category</option>
                      <option value="price">Price</option>
                      <option value="releasedate">Release date</option>
                      <option value="sculptor">Sculptor</option>
                      <option value="cooperation">Cooperation</option>
                    </optgroup>
                    <optgroup label="DB">
                      <option value="creatorname">Creator</option>
                      <option value="creationdate">Creation date</option>
                      <option value="editorname">Last editor</option>
                      <option value="editiondate">Last edition date</option>
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
    <boxes-tiles :boxes="displayedBoxes"></boxes-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import BoxesTiles from './dblayouts/BoxesTiles'

export default {
  name: 'Boxes',
  components: {
    AppBoxHeader,
    BoxesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'creationdate',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes']),
    displayedBoxes () {
      return this.boxes.concat().sort(this.sortBoxes)
    }
  },
  methods: {
    sortBoxes (a, b) {
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
  .db-box-category {
    font-weight: bold;
  }
  .db-box-series {
    font-style: italic;
  }
</style>
