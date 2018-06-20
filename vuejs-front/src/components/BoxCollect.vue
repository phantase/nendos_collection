<template>
  <div class="db-box" v-if="box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <a class="btn btn-app" :class="activated?'':'disabled'" style="float:right; margin:10px;" @click="collect">
                <span class="badge bg-green">{{partstocollect.length}}</span>
                <i class="fa fa-briefcase"></i>
                Collect
              </a>
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

    <div class="row" v-if="!activated && !finished">
      <div class="col-md-12">
        <div class="alert alert-info">
          <h4><i class="icon fa fa-info"></i>Collection in progress..</h4>
          <div class="progress">
            <div class="progress-bar" :style="'width: '+progresswidth+'%'"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="finished">
      <div class="col-md-12">
        <div class="alert alert-success">
          <h4><i class="icon fa fa-check"></i>Collection successful</h4>
          <router-link :to="'/box/'+this.$route.params.id">Go back to the box...</router-link>
        </div>
      </div>
    </div>

    <div class="row" v-if="activated">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">About the box collection</h3>
          </div>
          <div class="box-body">
            Choose the parts you want to add to your collection by clicking on it. By default, all of them are selected, so just click on <b>Collect</b> button (top right) to add the whole box.<br/>
            In <i style="background-color: #9e9;">Green</i>, the parts you will add to your collection.<br/>
            In <i style="background-color: #e99;">Red</i>, the parts you will <b>not</b> add to your collection.<br/>
            The badge <span class="badge bg-green">xxx</span> on the <i>Collect</i> button precises the number of parts that will be collected.<br/>
            Please note that if you have already collected some parts of this box, you will collect them again except if you deselect them in the list bellow.
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroids4box" :key="nendoroid.internalid">
          <nendoroid-tile :nendoroid="nendoroid"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></nendoroid-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces4box" :key="face.internalid">
          <face-tile :face="face"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></face-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs4box" :key="hair.internalid">
          <hair-tile :hair="hair"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></hair-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands4box" :key="hand.internalid">
          <hand-tile :hand="hand"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></hand-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodyparts4box" :key="bodypart.internalid">
          <bodypart-tile :bodypart="bodypart"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></bodypart-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessories4box" :key="accessory.internalid">
          <accessory-tile :accessory="accessory"
                    minimal="true" collectpage="true" @collect="collectpart" @dontcollect="dontcollectpart"></accessory-tile>
        </div>
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
import BodypartTile from './dblayouts/BodypartTile'
import AccessoryTile from './dblayouts/AccessoryTile'

export default {
  name: 'BoxCollect',
  components: {
    NendoroidTile,
    FaceTile,
    HairTile,
    HandTile,
    BodypartTile,
    AccessoryTile
  },
  store: store,
  data () {
    return {
      resources: Resources,
      partstocollect: [],
      activated: true,
      progress: 0
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories']),
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
    },
    progresswidth () {
      return this.progress * 100 / (this.partstocollect.length + 1)
    },
    finished () {
      return (this.partstocollect.length + 1) === this.progress
    }
  },
  methods: {
    ...Vuex.mapActions(['collectBox', 'collectNendoroid', 'collectFace', 'collectHair', 'collectHand', 'collectBodypart', 'collectAccessory']),
    collectpart (part, id) {
      if (this.partstocollect.indexOf(part + '@' + id) < 0) {
        this.partstocollect.push(part + '@' + id)
      }
    },
    dontcollectpart (part, id) {
      this.partstocollect.splice(this.partstocollect.indexOf(part + '@' + id), 1)
    },
    collect () {
      if (this.activated) {
        this.activated = false
        console.log('COLLECT...')
        this.partstocollect.forEach(function (element) {
          console.log(element)
          let pid = element.split('@')[1]
          switch (element.split('@')[0]) {
            case 'nendoroid':
              this.collectNendoroid({
                'context': this,
                'nendoroidid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
            case 'face':
              this.collectFace({
                'context': this,
                'faceid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
            case 'hair':
              this.collectHair({
                'context': this,
                'hairid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
            case 'hand':
              this.collectHand({
                'context': this,
                'handid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
            case 'bodypart':
              this.collectBodypart({
                'context': this,
                'bodypartid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
            case 'accessory':
              this.collectAccessory({
                'context': this,
                'accessoryid': pid
              }).then(() => {
                console.log('Collection successful')
                this.progress++
              }, () => {
                console.log('Collection failed')
                this.progress++
              })
              break
          }
        }, this)
        this.collectBox({
          'context': this,
          'boxid': this.box.internalid
        }).then(() => {
          console.log('Collection successful')
          this.progress++
        }, () => {
          console.log('Collection failed')
          this.progress++
        })
      }
    }
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
