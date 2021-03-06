<template>
  <div class="db-box" v-if="box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <a class="btn btn-app" :class="activated?'':'disabled'" style="float:right; margin:10px;" @click="validate">
                <span class="badge bg-green">{{partstovalidate.length}}</span>
                <i class="fa fa-check-square-o"></i>
                Validate
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
          <h4><i class="icon fa fa-info"></i>Validation in progress..</h4>
          <div class="progress">
            <div class="progress-bar" :style="'width: '+progresswidth+'%'"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="finished">
      <div class="col-md-12">
        <div class="alert alert-success">
          <h4><i class="icon fa fa-check"></i>Validation successful</h4>
          <router-link :to="'/box/'+this.$route.params.id">Go back to the box...</router-link>
        </div>
      </div>
    </div>

    <div class="row" v-if="activated">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">About the box validation</h3>
          </div>
          <div class="box-body">
            Choose the parts you want to validate by clicking on it. By default, all of them are selected, so just click on <b>Validate</b> button (top right) to validate the whole box.<br/>
            In <i style="background-color: #9e9;">Green</i>, the parts you will validate.<br/>
            In <i style="background-color: #e99;">Red</i>, the parts you will <b>not</b> validate.<br/>
            The badge <span class="badge bg-green">xxx</span> on the <i>Validate</i> button precises the number of parts that will be validated.
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroids4box" :key="nendoroid.internalid">
          <nendoroid-tile :nendoroid="nendoroid"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></nendoroid-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces4box" :key="face.internalid">
          <face-tile :face="face"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></face-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs4box" :key="hair.internalid">
          <hair-tile :hair="hair"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></hair-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands4box" :key="hand.internalid">
          <hand-tile :hand="hand"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></hand-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodyparts4box" :key="bodypart.internalid">
          <bodypart-tile :bodypart="bodypart"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></bodypart-tile>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessories4box" :key="accessory.internalid">
          <accessory-tile :accessory="accessory"
                    minimal="true" collectpage="true" @collect="validatepart" @dontcollect="dontvalidatepart"></accessory-tile>
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
  name: 'BoxValidate',
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
      partstovalidate: [],
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
      return this.progress * 100 / (this.partstovalidate.length + 1)
    },
    finished () {
      return (this.partstovalidate.length + 1) === this.progress
    }
  },
  methods: {
    ...Vuex.mapActions(['validateBox', 'validateNendoroid', 'validateFace', 'validateHair', 'validateHand', 'validateBodypart', 'validateAccessory']),
    validatepart (part, id) {
      if (this.partstovalidate.indexOf(part + '@' + id) < 0) {
        this.partstovalidate.push(part + '@' + id)
      }
    },
    dontvalidatepart (part, id) {
      this.partstovalidate.splice(this.partstovalidate.indexOf(part + '@' + id), 1)
    },
    validate () {
      if (this.activated) {
        this.activated = false
        console.log('VALIDATE...')
        this.partstovalidate.forEach(function (element) {
          console.log(element)
          let pid = element.split('@')[1]
          switch (element.split('@')[0]) {
            case 'nendoroid':
              this.validateNendoroid({
                'context': this,
                'nendoroidid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
            case 'face':
              this.validateFace({
                'context': this,
                'faceid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
            case 'hair':
              this.validateHair({
                'context': this,
                'hairid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
            case 'hand':
              this.validateHand({
                'context': this,
                'handid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
            case 'bodypart':
              this.validateBodypart({
                'context': this,
                'bodypartid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
            case 'accessory':
              this.validateAccessory({
                'context': this,
                'accessoryid': pid
              }).then(() => {
                console.log('Validation successful')
                this.progress++
              }, () => {
                console.log('Validation failed')
                this.progress++
              })
              break
          }
        }, this)
        this.validateBox({
          'context': this,
          'boxid': this.box.internalid
        }).then(() => {
          console.log('Validation successful')
          this.progress++
        }, () => {
          console.log('Validation failed')
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
