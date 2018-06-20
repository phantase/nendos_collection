<template>
  <div class="db-nendoroids">
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
                <optgroup label="Nendoroid">
                  <option value="name">Name</option>
                  <option value="version">Version</option>
                  <option value="sex">Gender</option>
                </optgroup>
                <optgroup label="Box">
                  <option value="box_number">Number</option>
                  <option value="box_name">Name</option>
                  <option value="box_series">Series</option>
                  <option value="box_manufacturer">Manufacturer</option>
                  <option value="box_category">Category</option>
                  <option value="box_price">Price</option>
                  <option value="box_releasedate">Release date</option>
                  <option value="box_sculptor">Sculptor</option>
                  <option value="box_cooperation">Cooperation</option>
                </optgroup>
                <optgroup label="DB">
                  <option value="creatorname">Creator</option>
                  <option value="creationdate" selected="">Creation date</option>
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
    <nendoroids-tiles :nendoroids="displayedNendoroids"></nendoroids-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'

export default {
  name: 'Nendoroids',
  components: {
    AppBoxHeader,
    NendoroidsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      filterincollection: 'all',
      filtervalidation: 'all',
      orderedby: 'creationdate',
      direction: 'desc',
      limit: 20
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids']),
    displayedNendoroids () {
      return this.nendoroids.filter(this.filterNendoroids).concat().sort(this.sortNendoroids).slice(0, this.limit)
    }
  },
  methods: {
    filterNendoroids (e) {
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
    sortNendoroids (a, b) {
      if (this.orderedby.startsWith('box_')) {
        let orderedbyNobox = this.orderedby.substring(4)
        if (this.boxes.find(box => box.internalid === a.boxid)[orderedbyNobox] > this.boxes.find(box => box.internalid === b.boxid)[orderedbyNobox]) {
          return this.direction === 'desc' ? -1 : 1
        } else {
          return this.direction === 'desc' ? 1 : -1
        }
      } else {
        if (a[this.orderedby] > b[this.orderedby]) {
          return this.direction === 'desc' ? -1 : 1
        } else {
          return this.direction === 'desc' ? 1 : -1
        }
      }
    }
  },
  mounted () {
    window.onscroll = () => {
      let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight
      if (bottomOfWindow) {
        this.limit += 20
      }
    }
  }
}
</script>

<style>
  .db-nendoroid-version {
    font-style: italic;
  }
</style>
