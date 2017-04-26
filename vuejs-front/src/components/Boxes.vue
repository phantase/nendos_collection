<template>
  <div class="db-boxes">
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="Sorting and filtering" collapsable="true" collapsed="true" icon="fa-filter"></app-box-header>
          <div class="box-body">
            <div class="pull-left">
              <span v-if="authenticated">
                <label>In collection: </label>
                <select v-model="filterincollection">
                  <option value="all">All</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </span>
              <span v-if="viewvalidation">
                <label>Validation: </label>
                <select v-model="filtervalidation">
                  <option value="all">All</option>
                  <option value="validated">Validated</option>
                  <option value="notvalidated">Not validated</option>
                </select>
              </span>
            </div>
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
      filterincollection: 'all',
      filtervalidation: 'all',
      orderedby: 'creationdate',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes']),
    displayedBoxes () {
      return this.boxes.filter(this.filterBoxes).concat().sort(this.sortBoxes)
    }
  },
  methods: {
    filterBoxes (e) {
      if (this.filterincollection === 'yes' && e.colladdeddate === null) {
        return false
      }
      if (this.filterincollection === 'no' && e.colladdeddate != null) {
        return false
      }
      if (this.filtervalidation === 'validated' && e.validationdate === null) {
        return false
      }
      if (this.filtervalidation === 'notvalidated' && e.validationdate != null) {
        return false
      }
      return true
    },
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
