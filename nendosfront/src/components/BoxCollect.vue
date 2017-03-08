<template>
  <div class="db-box" v-if="box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-box-category text-yellow">
                <span>{{ box.category}}</span>
                <span v-if="box.number">#{{ box.number}}</span>
              </div>
              <div class="db-box-name">{{ box.name }}</div>
              <div class="db-box-series">{{ box.series }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Collect a box</h3>
          </div>
          <div class="box-body">
            Choose the parts you want to add to your collection. By default, all of them are select, so just click on <b>Collect</b> button to add the whole box.<br/>
            Please note that the parts you have already collected will not be collected again. If you want to add another copy to your collection, go to the page of the part and add a new copy.<br/>
            In <i style="background-color: #ddd;">Grey</i>, the parts already in your collection.
            In <i style="background-color: #9e9;">Green</i>, the parts you will add to your collection.
            In <i style="background-color: #e99;">Red</i>, the parts you will <b>not</b> add to your collection.
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroids4box">
          <nendoroid-tile :nendoroid="nendoroid" minimal="true" collectpage="true"></nendoroid-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces4box">
          <face-tile :face="face" minimal="true" collectpage="true"></face-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs4box">
          <hair-tile :hair="hair" minimal="true" collectpage="true"></hair-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands4box">
          <hand-tile :hand="hand" minimal="true" collectpage="true"></hand-tile>
        </div>
        <bodyparts-tiles :bodyparts="bodyparts4box" norow="true"></bodyparts-tiles>
        <accessories-tiles :accessories="accessories4box" norow="true"></accessories-tiles>
      </div>
    </div>

  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import NendoroidTile from './dblayouts/NendoroidTile'
import FaceTile from './dblayouts/FaceTile'
import HairTile from './dblayouts/HairTile'
import HandTile from './dblayouts/HandTile'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'

export default {
  name: 'BoxCollect',
  components: {
    NendoroidTile,
    FaceTile,
    HairTile,
    HandTile,
    BodypartsTiles,
    AccessoriesTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'authenticated', 'viewvalidation']),
    box () {
      return this.boxes.filter(box => box.internalid === this.$route.params.id)[0]
    },
    nendoroids4box () {
      return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.$route.params.id)
    },
    faces4box () {
      return this.faces.filter(face => face.boxid === this.$route.params.id)
    },
    hairs4box () {
      return this.hairs.filter(hair => hair.boxid === this.$route.params.id)
    },
    hands4box () {
      return this.hands.filter(hand => hand.boxid === this.$route.params.id)
    },
    bodyparts4box () {
      return this.bodyparts.filter(bodypart => bodypart.boxid === this.$route.params.id)
    },
    accessories4box () {
      return this.accessories.filter(accessory => accessory.boxid === this.$route.params.id)
    }
  },
  methods: {
    ...Vuex.mapActions(['collectBox', 'uncollectBox', 'validateBox', 'unvalidateBox'])
  }
}
</script>

<style scoped>
  .list-group-item a {
    width: calc(100% - 8em);
    text-align: right;
  }
  .pull-right+br {
    clear: both;
  }
</style>
