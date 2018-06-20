<template>
  <div class="db-faces">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
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
                <optgroup label="Face">
                  <option value="eyes_color">Eyes color</option>
                  <option value="skin_color">Skin color</option>
                  <option value="sex">Gender</option>
                </optgroup>
                <optgroup label="Nendoroid">
                  <option value="nendoroid_name">Name</option>
                  <option value="nendoroid_version">Version</option>
                  <option value="nendoroid_sex">Gender</option>
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
    <faces-tiles :faces="displayedFaces"></faces-tiles>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import FacesTiles from './dblayouts/FacesTiles'

export default {
  name: 'Faces',
  components: {
    AppBoxHeader,
    FacesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      filterincollection: 'all',
      filtervalidation: 'all',
      limit: 20
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids', 'faces', 'facesOrderedBy', 'facesDirection']),
    displayedFaces () {
      return this.faces.filter(this.filterFaces).concat().sort(this.sortFaces).slice(0, this.limit)
    },
    orderedby: {
      get () {
        return this.facesOrderedBy
      },
      set (newValue) {
        this.setFacesOrderedBy(newValue)
      }
    },
    direction: {
      get () {
        return this.facesDirection
      },
      set (newValue) {
        this.setFacesDirection(newValue)
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['setFacesOrderedBy', 'setFacesDirection']),
    filterFaces (e) {
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
    sortFaces (a, b) {
      if (this.orderedby.startsWith('box_')) {
        let orderedbyNobox = this.orderedby.substring(4)
        if (this.boxes.find(box => box.internalid === a.boxid)[orderedbyNobox] > this.boxes.find(box => box.internalid === b.boxid)[orderedbyNobox]) {
          return this.direction === 'desc' ? -1 : 1
        } else {
          return this.direction === 'desc' ? 1 : -1
        }
      } else if (this.orderedby.startsWith('nendoroid_')) {
        let orderedbyNoNendoroid = this.orderedby.substring(10)
        let nendoA = this.nendoroids.find(nendoroid => nendoroid.internalid === a.nendoroidid)
        let nendoB = this.nendoroids.find(nendoroid => nendoroid.internalid === b.nendoroidid)
        if (nendoA === undefined && nendoB === undefined) {
          return 0
        } else if (nendoA === undefined && nendoB) {
          return this.direction === 'desc' ? 1 : -1
        } else if (nendoA && nendoB === undefined) {
          return this.direction === 'desc' ? -1 : 1
        } else if (nendoA[orderedbyNoNendoroid] > nendoB[orderedbyNoNendoroid]) {
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
