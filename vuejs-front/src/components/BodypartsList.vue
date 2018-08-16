<template>
  <div class="db-bodyparts">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            <table>
              <tr>
                <th @click="setBodypartsOrderedBy('internalid')">internalid <i class="pull-right fa" :class="orderedby==='internalid'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
                <th @click="setBodypartsOrderedBy('part')">Part <i class="pull-right fa" :class="orderedby==='part'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
                <th @click="setBodypartsOrderedBy('main_color')">Main color <i class="pull-right fa" :class="orderedby==='main_color'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
                <th @click="setBodypartsOrderedBy('other_color')">Other color <i class="pull-right fa" :class="orderedby==='other_color'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
                <th @click="setBodypartsOrderedBy('description')">Description <i class="pull-right fa" :class="orderedby==='description'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
                <th @click="setBodypartsOrderedBy('nbpictures')"># pictures <i class="pull-right fa" :class="orderedby==='nbpictures'?direction==='asc'?'fa-arrow-up':'fa-arrow-down':'fa-circle-o'"></i></th>
              </tr>
              <tr>
                <td><input v-model="filterInternalid"/></td>
                <td><input v-model="filterPart"/></td>
                <td><input v-model="filterMainColor"/></td>
                <td><input v-model="filterOtherColor"/></td>
                <td><input v-model="filterDescription"/></td>
                <td><input v-model="filterNbPictures"/></td>
              </tr>
              <tr v-for="bodypart in displayedBodyparts" :key="bodypart.internalid">
                <td><router-link :to="'/bodypart/'+bodypart.internalid">{{ bodypart.internalid }}</router-link></td>
                <td>{{ bodypart.part }}</td>
                <td>{{ bodypart.main_color }}</td>
                <td>{{ bodypart.other_color }}</td>
                <td>{{ bodypart.description }}</td>
                <td>{{ bodypart.nbpictures }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import BodypartsTiles from './dblayouts/BodypartsTiles'

export default {
  name: 'BodypartsList',
  components: {
    AppBoxHeader,
    BodypartsTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'internalid',
      direction: 'desc',
      filterInternalid: null,
      filterPart: null,
      filterMainColor: null,
      filterOtherColor: null,
      filterDescription: null,
      filterNbPictures: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids', 'bodyparts', 'bodypartsOrderedBy', 'bodypartsDirection']),
    displayedBodyparts () {
      return this.bodyparts.filter(this.filterBodyparts).concat().sort(this.sortBodyparts)
    }
  },
  methods: {
    setBodypartsOrderedBy (part) {
      if (this.orderedby === part) {
        this.setBodypartsDirection(this.direction === 'asc' ? 'desc' : 'asc')
      } else {
        this.setBodypartsDirection('asc')
      }
      this.orderedby = part
    },
    setBodypartsDirection (dir) {
      this.direction = dir
    },
    filterBodyparts (e) {
      if (this.filterInternalid && e.internalid.toLowerCase().indexOf(this.filterInternalid.toLowerCase()) === -1) {
        return false
      }
      if (this.filterPart && e.part.toLowerCase().indexOf(this.filterPart.toLowerCase()) === -1) {
        return false
      }
      if (this.filterMainColor && e.main_color.toLowerCase().indexOf(this.filterMainColor.toLowerCase()) === -1) {
        return false
      }
      if (this.filterOtherColor && e.other_color && e.other_color.toLowerCase().indexOf(this.filterOtherColor.toLowerCase()) === -1) {
        return false
      } else if (this.filterOtherColor && !e.other_color) {
        return false
      }
      if (this.filterDescription && e.description.toLowerCase().indexOf(this.filterDescription.toLowerCase()) === -1) {
        return false
      }
      if (this.filterNbPictures && e.nbpictures.toLowerCase().indexOf(this.filterNbPictures.toLowerCase()) === -1) {
        return false
      }
      return true
    },
    sortBodyparts (a, b) {
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
      } else if (this.orderedby === 'internalid') {
        if ((a[this.orderedby]) * 1 > (b[this.orderedby]) * 1) {
          return this.direction === 'desc' ? -1 : 1
        } else {
          return this.direction === 'desc' ? 1 : -1
        }
      } else {
        if (a[this.orderedby] === null && b[this.orderedby] === null) {
          return 0
        } else if (a[this.orderedby] === null && b[this.orderedby]) {
          return this.direction === 'desc' ? 1 : -1
        } else if (a[this.orderedby] && b[this.orderedby] === null) {
          return this.direction === 'desc' ? -1 : 1
        } else if (a[this.orderedby] > b[this.orderedby]) {
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
<style scoped>
  table {
    border: 1px solid grey;
    width: 100%;
  }
  th {
    border: solid 1px grey;
    background-color: lightgrey;
    padding: 2px;
    cursor: pointer;
  }
  td {
    border: 1px dashed grey;
    padding: 2px;
  }
</style>
