<template>
  <div class="db-faces">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            <table>
              <tr>
                <th @click="setFacesOrderedBy('internalid')">internalid
                  <i class="pull-right fa" :class="orderedby==='internalid'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('eyes')">Eyes [{{displayedFaces.length}} / {{faces.length}}]
                  <i class="pull-right fa" :class="orderedby==='eyes'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('eyes_color')">Eyes color
                  <i class="pull-right fa" :class="orderedby==='eyes_color'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('mouth')">Mouth
                  <i class="pull-right fa" :class="orderedby==='mouth'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('skin_color')">Skin color
                  <i class="pull-right fa" :class="orderedby==='skin_color'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('sex')">Gender 
                  <i class="pull-right fa" :class="orderedby==='sex'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setFacesOrderedBy('nbpictures')"># pictures 
                  <i class="pull-right fa" :class="orderedby==='nbpictures'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
              </tr>
              <tr>
                <td><input v-model="filterInternalid" placeholder="filter"/></td>
                <td><input v-model="filterEyes" placeholder="filter"/></td>
                <td><input v-model="filterEyesColor" placeholder="filter"/></td>
                <td><input v-model="filterMouth" placeholder="filter"/></td>
                <td><input v-model="filterSkinColor" placeholder="filter"/></td>
                <td><input v-model="filterSex" placeholder="filter"/></td>
                <td><input v-model="filterNbPictures" placeholder="filter"/></td>
              </tr>
              <tr v-for="face in displayedFaces" :key="face.internalid">
                <td><router-link :to="'/face/'+face.internalid">{{ face.internalid }}</router-link></td>
                <td>{{ face.eyes }}</td>
                <td>{{ face.eyes_color }}</td>
                <td>{{ face.mouth }}</td>
                <td>{{ face.skin_color }}</td>
                <td>{{ face.sex }}</td>
                <td>{{ face.nbpictures }}</td>
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
  name: 'FacesList',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'internalid',
      direction: 'desc',
      filterInternalid: null,
      filterEyes: null,
      filterEyesColor: null,
      filterMouth: null,
      filterSkinColor: null,
      filterSex: null,
      filterNbPictures: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids', 'faces', 'facesOrderedBy', 'facesDirection']),
    displayedFaces () {
      return this.faces.filter(this.filterFaces).concat().sort(this.sortFaces).slice(0, this.limit)
    }
  },
  methods: {
    setFacesOrderedBy (part) {
      if (this.orderedby === part) {
        this.setFacesDirection(this.direction === 'asc' ? 'desc' : 'asc')
      } else {
        this.setFacesDirection('asc')
      }
      this.orderedby = part
    },
    setFacesDirection (dir) {
      this.direction = dir
    },
    filterFaces (e) {
      if (this.filterInternalid && e.internalid.toLowerCase().indexOf(this.filterInternalid.toLowerCase()) === -1) {
        return false
      }
      if (this.filterEyes && e.eyes.toLowerCase().indexOf(this.filterEyes.toLowerCase()) === -1) {
        return false
      }
      if (this.filterEyesColor && e.eyes_color.toLowerCase().indexOf(this.filterEyesColor.toLowerCase()) === -1) {
        return false
      }
      if (this.filterMouth && e.mouth.toLowerCase().indexOf(this.filterMouth.toLowerCase()) === -1) {
        return false
      }
      if (this.filterSkinColor && e.skin_color.toLowerCase().indexOf(this.filterSkinColor.toLowerCase()) === -1) {
        return false
      }
      if (this.filterSex && e.sex.toLowerCase().indexOf(this.filterSex.toLowerCase()) === -1) {
        return false
      }
      if (this.filterNbPictures && e.nbpictures.toLowerCase().indexOf(this.filterNbPictures.toLowerCase()) === -1) {
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
