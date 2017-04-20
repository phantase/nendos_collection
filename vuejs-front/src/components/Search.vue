<template>
  <div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <app-box-header title="Search parameters" collapsable="true" icon="fa-binoculars"></app-box-header>
          <div class="box-body">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li><a href="#tab_photos"       data-toggle="tab" aria-expanded="true"><i class="fa fa-image"                   ></i> Photos      <span class="pull-right-container"><small class="badge bg-blue">{{ photosfound.length       }}</small></span></a></li>
            <li><a href="#tab_accessories"  data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_accessories"></i> Accessories <span class="pull-right-container"><small class="badge bg-blue">{{ accessoriesfound.length  }}</small></span></a></li>
            <li><a href="#tab_bodyparts"    data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_body"       ></i> Bodyparts   <span class="pull-right-container"><small class="badge bg-blue">{{ bodypartsfound.length    }}</small></span></a></li>
            <li><a href="#tab_hands"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hand"       ></i> Hands       <span class="pull-right-container"><small class="badge bg-blue">{{ handsfound.length        }}</small></span></a></li>
            <li><a href="#tab_hairs"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hair"       ></i> Hairs       <span class="pull-right-container"><small class="badge bg-blue">{{ hairsfound.length        }}</small></span></a></li>
            <li><a href="#tab_faces"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_face"       ></i> Faces       <span class="pull-right-container"><small class="badge bg-blue">{{ facesfound.length        }}</small></span></a></li>
            <li><a href="#tab_nendoroids"   data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_nendo"      ></i> Nendoroids  <span class="pull-right-container"><small class="badge bg-blue">{{ nendoroidsfound.length   }}</small></span></a></li>
            <li class="active"><a href="#tab_boxes"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_boxes"      ></i>Boxes      <span class="pull-right-container"><small class="badge bg-blue">{{ boxesfound.length  }}</small></span></a></li>
            <li class="pull-left header">Results</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab_photos">
              <div class="row">
                <router-link :to="'/photo/'+photo.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="photo in photosfound">
                  <photo-tile :photo="photo"></photo-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_accessories">
              <div class="row">
                <router-link :to="'/accessory/'+accessory.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessoriesfound">
                  <accessory-tile :accessory="accessory"></accessory-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_bodyparts">
              <div class="row">
                <router-link :to="'/bodypart/'+bodypart.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodypartsfound">
                  <bodypart-tile :bodypart="bodypart"></bodypart-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_hands">
              <div class="row">
                <router-link :to="'/hand/'+hand.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hand in handsfound">
                  <hand-tile :hand="hand"></hand-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_hairs">
              <div class="row">
                <router-link :to="'/hair/'+hair.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairsfound">
                  <hair-tile :hair="hair"></hair-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_faces">
              <div class="row">
                <router-link :to="'/face/'+face.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="face in facesfound">
                  <face-tile :face="face"></face-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane" id="tab_nendoroids">
              <div class="row">
                <router-link :to="'/nendoroid/'+nendoroid.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroidsfound">
                  <nendoroid-tile :nendoroid="nendoroid"></nendoroid-tile>
                </router-link>
              </div>
            </div>
            <div class="tab-pane active" id="tab_boxes">
              <div class="row">
                <router-link :to="'/box/'+box.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="box in boxesfound">
                  <box-tile :box="box"></box-tile>
                </router-link>
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
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos', 'authenticated', 'viewvalidation']),
    boxesfound () {
      return this.boxes
    },
    nendoroidsfound () {
      return this.nendoroids
    },
    facesfound () {
      return this.faces
    },
    hairsfound () {
      return this.hairs
    },
    handsfound () {
      return this.hands
    },
    bodypartsfound () {
      return this.bodyparts
    },
    accessoriesfound () {
      return this.accessories
    },
    photosfound () {
      return this.photos
    }
  },
  methods: {
  }
}
</script>

<style scoped>
</style>
