<template>
  <div class="db-hands">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-body">
            <table>
              <tr>
                <th @click="setHandsOrderedBy('internalid')">internalid
                  <i class="pull-right fa" :class="orderedby==='internalid'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHandsOrderedBy('skin_color')">Skin color
                  <i class="pull-right fa" :class="orderedby==='skin_color'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHandsOrderedBy('leftright')">Left/Right
                  <i class="pull-right fa" :class="orderedby==='leftright'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHandsOrderedBy('posture')">Posture 
                  <i class="pull-right fa" :class="orderedby==='posture'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHandsOrderedBy('description')">Description  [{{displayedHands.length}} / {{hands.length}}]
                  <i class="pull-right fa" :class="orderedby==='description'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
                <th @click="setHandsOrderedBy('nbpictures')"># pictures 
                  <i class="pull-right fa" :class="orderedby==='nbpictures'?direction==='asc'?'fa-sort-up':'fa-sort-down':'fa-sort'"></i>
                </th>
              </tr>
              <tr>
                <td><input v-model="filterInternalid" placeholder="filter"/></td>
                <td><input v-model="filterSkinColor" placeholder="filter"/></td>
                <td><input v-model="filterLeftright" placeholder="filter"/></td>
                <td><input v-model="filterPosture" placeholder="filter"/></td>
                <td><input v-model="filterDescription" placeholder="filter"/></td>
                <td><input v-model="filterNbPictures" placeholder="filter"/></td>
              </tr>
              <tr v-for="hand in displayedHands" :key="hand.internalid">
                <td><router-link :to="'/hand/'+hand.internalid">{{ hand.internalid }}</router-link></td>
                <td>{{ hand.skin_color }}</td>
                <td>{{ hand.leftright }}</td>
                <td>{{ hand.posture }}</td>
                <td>{{ hand.description }}</td>
                <td>{{ hand.nbpictures }}</td>
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
  name: 'HandsList',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'internalid',
      direction: 'desc',
      filterInternalid: null,
      filterSkinColor: null,
      filterLeftright: null,
      filterPosture: null,
      filterDescription: null,
      filterNbPictures: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'boxes', 'nendoroids', 'hands', 'handsOrderedBy', 'handsDirection']),
    displayedHands () {
      return this.hands.filter(this.filterHands).concat().sort(this.sortHands).slice(0, this.limit)
    }
  },
  methods: {
    setHandsOrderedBy (part) {
      if (this.orderedby === part) {
        this.setHandsDirection(this.direction === 'asc' ? 'desc' : 'asc')
      } else {
        this.setHandsDirection('asc')
      }
      this.orderedby = part
    },
    setHandsDirection (dir) {
      this.direction = dir
    },
    filterHands (e) {
      if (this.filterInternalid && e.internalid.toLowerCase().indexOf(this.filterInternalid.toLowerCase()) === -1) {
        return false
      }
      if (this.filterSkinColor && e.skin_color.toLowerCase().indexOf(this.filterSkinColor.toLowerCase()) === -1) {
        return false
      }
      if (this.filterLeftright && e.leftright.toLowerCase().indexOf(this.filterLeftright.toLowerCase()) === -1) {
        return false
      }
      if (this.filterPosture && e.posture && e.posture.toLowerCase().indexOf(this.filterPosture.toLowerCase()) === -1) {
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
    sortHands (a, b) {
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
