<template>
  <div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <app-box-header title="Search parameters" collapsable="true" icon="fa-binoculars"></app-box-header>
          <div class="box-body">
            <div class="form-group" :class="errornotext?'has-error':''">
              <label for="simpletext">Enter search terms bellow</label>
              <input type="text" class="form-control" id="simpletext" placeholder="search terms" v-model="searchSimpletext">
              <span class="help-block" v-if="errornotext">The search terms cannot be empty.</span>
            </div>
            <div class="form-group">
              <div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" v-model="searchStrictMode"> Strict search <i class="fa fa-question-circle-o" data-toggle="tooltip" title="When strict search is checked, 'love' will return the exact word 'love' in the fields, but not 'LoveLive!' for example. And 'Mik' will probably return nothing in strict mode but will return a lot of 'Miku' and some 'Mikoto' when this option is unchecked."></i>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-default" @click="cancelSearch">Cancel</button>
            <button type="submit" class="btn btn-warning pull-right" @click="submitSearch">Search</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-show="searchPerformed">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li><a href="#tab_photos"       data-toggle="tab" aria-expanded="true"><i class="fa fa-image"                   ></i><span class="label label-warning">{{ photosfound.length}}</span> Photos      </a></li>
            <li><a href="#tab_accessories"  data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_accessories"></i><span class="label label-warning">{{ accessoriesfound.length}}</span> Accessories </a></li>
            <li><a href="#tab_bodyparts"    data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_body"       ></i><span class="label label-warning">{{ bodypartsfound.length}}</span> Bodyparts   </a></li>
            <li><a href="#tab_hands"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hand"       ></i><span class="label label-warning">{{ handsfound.length}}</span> Hands       </a></li>
            <li><a href="#tab_hairs"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hair"       ></i><span class="label label-warning">{{ hairsfound.length}}</span> Hairs       </a></li>
            <li><a href="#tab_faces"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_face"       ></i><span class="label label-warning">{{ facesfound.length}}</span> Faces       </a></li>
            <li><a href="#tab_nendoroids"   data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_nendo"      ></i><span class="label label-warning">{{ nendoroidsfound.length}}</span> Nendoroids  </a></li>
            <li class="active"><a href="#tab_boxes"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_boxes"      ></i><span class="label label-warning">{{ boxesfound.length}}</span> Boxes      </a></li>
            <li class="pull-left header">Results</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab_photos">
              <div class="row">
                <router-link :to="'/photo/'+photo.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="photo in photosfound" :key="photo.internalid">
                  <photo-tile :photo="photo"></photo-tile>
                </router-link>
                <span class="col-md-12" v-if="photosfound.length === 0">
                  <i>Oh... We found no photo for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_accessories">
              <div class="row">
                <router-link :to="'/accessory/'+accessory.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessoriesfound" :key="accessory.internalid">
                  <accessory-tile :accessory="accessory"></accessory-tile>
                </router-link>
                <span class="col-md-12" v-if="accessoriesfound.length === 0">
                  <i>Oh... We found no accessory for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_bodyparts">
              <div class="row">
                <router-link :to="'/bodypart/'+bodypart.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodypartsfound" :key="bodypart.internalid">
                  <bodypart-tile :bodypart="bodypart"></bodypart-tile>
                </router-link>
                <span class="col-md-12" v-if="bodypartsfound.length === 0">
                  <i>Oh... We found no bodypart for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_hands">
              <div class="row">
                <router-link :to="'/hand/'+hand.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hand in handsfound" :key="hand.internalid">
                  <hand-tile :hand="hand"></hand-tile>
                </router-link>
                <span class="col-md-12" v-if="handsfound.length === 0">
                  <i>Oh... We found no hand for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_hairs">
              <div class="row">
                <router-link :to="'/hair/'+hair.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairsfound" :key="hair.internalid">
                  <hair-tile :hair="hair"></hair-tile>
                </router-link>
                <span class="col-md-12" v-if="hairsfound.length === 0">
                  <i>Oh... We found no hairs for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_faces">
              <div class="row">
                <router-link :to="'/face/'+face.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="face in facesfound" :key="face.internalid">
                  <face-tile :face="face"></face-tile>
                </router-link>
                <span class="col-md-12" v-if="facesfound.length === 0">
                  <i>Oh... We found no face for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane" id="tab_nendoroids">
              <div class="row">
                <router-link :to="'/nendoroid/'+nendoroid.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroidsfound" :key="nendoroid.internalid">
                  <nendoroid-tile :nendoroid="nendoroid"></nendoroid-tile>
                </router-link>
                <span class="col-md-12" v-if="nendoroidsfound.length === 0">
                  <i>Oh... We found no nendoroid for this search...</i>
                </span>
              </div>
            </div>
            <div class="tab-pane active" id="tab_boxes">
              <div class="row">
                <router-link :to="'/box/'+box.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="box in boxesfound" :key="box.internalid">
                  <box-tile :box="box"></box-tile>
                </router-link>
                <span class="col-md-12" v-if="boxesfound.length === 0">
                  <i>Oh... We found no box for this search...</i>
                </span>
              </div>
            </div>
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

import BoxTile from './dblayouts/BoxTile'
import NendoroidTile from './dblayouts/NendoroidTile'
import FaceTile from './dblayouts/FaceTile'
import HairTile from './dblayouts/HairTile'
import HandTile from './dblayouts/HandTile'
import BodypartTile from './dblayouts/BodypartTile'
import AccessoryTile from './dblayouts/AccessoryTile'
import PhotoTile from './dblayouts/PhotoTile'

export default {
  name: 'Search',
  components: {
    AppBoxHeader,
    BoxTile,
    NendoroidTile,
    FaceTile,
    HairTile,
    HandTile,
    BodypartTile,
    AccessoryTile,
    PhotoTile
  },
  store: store,
  data () {
    return {
      resources: Resources,
      errornotext: false,
      searchSimpletext: null,
      searchSimpletextValidated: null,
      searchStrictMode: false,
      searchPerformed: false,
      boxesfound: [],
      nendoroidsfound: [],
      facesfound: [],
      hairsfound: [],
      handsfound: [],
      bodypartsfound: [],
      accessoriesfound: [],
      photosfound: []
    }
  },
  computed: {
    ...Vuex.mapGetters(['searchTerm', 'boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos'])
  },
  methods: {
    ...Vuex.mapActions(['doSearch', 'resetSearchTerm']),
    submitSearch () {
      this.errornotext = false
      this.searchPerformed = false
      if (this.searchSimpletext) {
        console.log('submitSearch')
        this.searchSimpletextValidated = this.searchSimpletext.toLowerCase()
        this.resetSearchTerm()
        this.boxesfound = []
        this.nendoroidsfound = []
        this.accessoriesfound = []
        this.bodypartsfound = []
        this.facesfound = []
        this.hairsfound = []
        this.handsfound = []
        this.photosfound = []
        this.doSearch({
          'queryTerm': this.searchSimpletextValidated,
          'strictMode': this.searchStrictMode
        }).then((results) => {
          this.searchPerformed = true
          console.log(results)
          results.boxes.forEach((searchBoxResult) => {
            this.boxesfound.push(this.boxes.find(box => box.internalid === searchBoxResult.ref))
          })
          results.nendoroids.forEach((searchNendoroidResult) => {
            this.nendoroidsfound.push(this.nendoroids.find(nendoroid => nendoroid.internalid === searchNendoroidResult.ref))
          })
          results.accessories.forEach((searchAccessoriesesult) => {
            this.accessoriesfound.push(this.accessories.find(accessory => accessory.internalid === searchAccessoriesesult.ref))
          })
          results.bodyparts.forEach((searchBodypartResult) => {
            this.bodypartsfound.push(this.bodyparts.find(bodypart => bodypart.internalid === searchBodypartResult.ref))
          })
          results.faces.forEach((searchFaceResult) => {
            this.facesfound.push(this.faces.find(face => face.internalid === searchFaceResult.ref))
          })
          results.hairs.forEach((searchHairResult) => {
            this.hairsfound.push(this.hairs.find(hair => hair.internalid === searchHairResult.ref))
          })
          results.hands.forEach((searchHandResult) => {
            this.handsfound.push(this.hands.find(hand => hand.internalid === searchHandResult.ref))
          })
          results.photos.forEach((searchPhotoResult) => {
            this.photosfound.push(this.photos.find(photo => photo.internalid === searchPhotoResult.ref))
          })
        })
      } else {
        this.errornotext = true
        this.searchPerformed = false
      }
    },
    cancelSearch () {
      console.log('cancelSearch')
      this.errornotext = false
      this.searchPerformed = false
      this.searchSimpletext = null
      this.searchSimpletextValidated = null
      this.searchStrictMode = false
      this.boxesfound = []
      this.nendoroidsfound = []
      this.accessoriesfound = []
      this.bodypartsfound = []
      this.facesfound = []
      this.hairsfound = []
      this.handsfound = []
      this.photosfound = []
    },
    doQueryTermSearch () {
      if (this.searchTerm) {
        this.searchSimpletext = this.searchTerm
        this.submitSearch()
      }
    }
  },
  mounted () {
    this.doQueryTermSearch()
  }
}
</script>

<style scoped>
.nav-tabs > li > a > .label {
  position: absolute;
  top: 7px;
  left: 23px;
  text-align: center;
  font-size: 9px;
  padding: 2px 3px;
  line-height: .9;
}
.nav-tabs > li > a > i {
  padding-right: 10px;
  font-size: 20px;
}
</style>
