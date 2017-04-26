<template>
  <div class="db-nendoroids">
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="Sorting and filtering" collapsable="true" collapsed="true" icon="fa-filter"></app-box-header>
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="checkbox" v-if="authenticated">
                  <label>
                    <input type="checkbox" v-model="onlyincollection">
                    Only in my collection
                  </label>
                </div>
              </div>
              <div class="col-md-4">
                <!-- Here, the other filters... -->
              </div>
              <div class="col-md-4">
                <div class="pull-right">
                  <label>Sort by: </label>
                  <select v-model="orderedby">
                    <optgroup label="Nendoroid">
                      <option value="name">Name</option>
                      <option value="version">Version</option>
                      <option value="sex">Sex</option>
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
      onlyincollection: false,
      orderedby: 'creationdate',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'boxes', 'nendoroids']),
    displayedNendoroids () {
      return this.nendoroids.filter(this.filterNendoroids).concat().sort(this.sortNendoroids)
    }
  },
  methods: {
    filterNendoroids (e) {
      if (this.onlyincollection) {
        if (e.colladdeddate) {
          return true
        } else {
          return false
        }
      } else {
        return true
      }
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
  }
}
</script>

<style>
  .db-nendoroid-version {
    font-style: italic;
  }
</style>
