<template>
  <div class="db-hairs">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            <table>
              <tr>
                <th @click="setHairsOrderedBy('internalid')">internalid
                  <i class="pull-right fa" :class="orderedby==='internalid'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('haircut')">Haircut 
                  <i class="pull-right fa" :class="orderedby==='haircut'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('main_color')">Main color 
                  <i class="pull-right fa" :class="orderedby==='main_color'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('other_color')">Other color 
                  <i class="pull-right fa" :class="orderedby==='other_color'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('frontback')">Front/back 
                  <i class="pull-right fa" :class="orderedby==='frontback'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('description')">Description  [{{displayedHairs.length}} / {{hairs.length}}]
                  <i class="pull-right fa" :class="orderedby==='description'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHairsOrderedBy('nbpictures')"># pictures 
                  <i class="pull-right fa" :class="orderedby==='nbpictures'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
              </tr>
              <tr>
                <td><input v-model="filterInternalid" placeholder="filter"/></td>
                <td><input v-model="filterHaircut" placeholder="filter"/></td>
                <td><input v-model="filterMainColor" placeholder="filter"/></td>
                <td><input v-model="filterOtherColor" placeholder="filter"/></td>
                <td><input v-model="filterFrontback" placeholder="filter"/></td>
                <td><input v-model="filterDescription" placeholder="filter"/></td>
                <td><input v-model="filterNbPictures" placeholder="filter"/></td>
              </tr>
              <tr v-for="hair in displayedHairs" :key="hair.internalid">
                <td><router-link :to="'/hair/'+hair.internalid">{{ hair.internalid }}</router-link></td>
                <td>{{ hair.haircut }}</td>
                <td>{{ hair.main_color }}</td>
                <td>{{ hair.other_color }}</td>
                <td>{{ hair.frontback }}</td>
                <td>{{ hair.description }}</td>
                <td>{{ hair.nbpictures }}</td>
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

export default {
  name: 'HairsList',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'internalid',
      direction: 'desc',
      filterInternalid: null,
      filterHaircut: null,
      filterMainColor: null,
      filterOtherColor: null,
      filterFrontback: null,
      filterDescription: null,
      filterNbPictures: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids', 'hairs', 'hairsOrderedBy', 'hairsDirection']),
    displayedHairs () {
      return this.hairs.filter(this.filterHairs).concat().sort(this.sortHairs).slice(0, this.limit)
    }
  },
  methods: {
    setHairsOrderedBy (part) {
      if (this.orderedby === part) {
        this.setHairsDirection(this.direction === 'asc' ? 'desc' : 'asc')
      } else {
        this.setHairsDirection('asc')
      }
      this.orderedby = part
    },
    setHairsDirection (dir) {
      this.direction = dir
    },
    filterHairs (e) {
      if (this.filterInternalid && e.internalid.toLowerCase().indexOf(this.filterInternalid.toLowerCase()) === -1) {
        return false
      }
      if (this.filterHaircut && e.haircut.toLowerCase().indexOf(this.filterHaircut.toLowerCase()) === -1) {
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
      if (this.filterFrontback && e.frontback.toLowerCase().indexOf(this.filterFrontback.toLowerCase()) === -1) {
        return false
      }
      if (this.filterNbPictures && e.nbpictures.toLowerCase().indexOf(this.filterNbPictures.toLowerCase()) === -1) {
        return false
      }
      return true
    },
    sortHairs (a, b) {
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

  td > input {
    width: 100%;
  }
</style>
