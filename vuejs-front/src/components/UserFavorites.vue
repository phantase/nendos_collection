<template>
  <div class="db-box" v-if="user">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-box-category text-yellow">
                <span>{{ user.username}}</span>
              </div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="User's favorites" collapsable="true" icon="fa-heart"></app-box-header>
          <div class="box-body">
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
                <li class="pull-left header">Favorites</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="tab_photos">
                  <div class="row">
                    <router-link :to="'/photo/'+photo.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="photo in photosfound">
                      <photo-tile :photo="photo"></photo-tile>
                    </router-link>
                    <span class="col-md-12" v-if="photosfound.length === 0">
                      <i>User has no photo in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_accessories">
                  <div class="row">
                    <router-link :to="'/accessory/'+accessory.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessoriesfound">
                      <accessory-tile :accessory="accessory"></accessory-tile>
                    </router-link>
                    <span class="col-md-12" v-if="accessoriesfound.length === 0">
                      <i>User has no accessory in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_bodyparts">
                  <div class="row">
                    <router-link :to="'/bodypart/'+bodypart.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodypartsfound">
                      <bodypart-tile :bodypart="bodypart"></bodypart-tile>
                    </router-link>
                    <span class="col-md-12" v-if="bodypartsfound.length === 0">
                      <i>User has no bodypart in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_hands">
                  <div class="row">
                    <router-link :to="'/hand/'+hand.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hand in handsfound">
                      <hand-tile :hand="hand"></hand-tile>
                    </router-link>
                    <span class="col-md-12" v-if="handsfound.length === 0">
                      <i>User has no hand in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_hairs">
                  <div class="row">
                    <router-link :to="'/hair/'+hair.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairsfound">
                      <hair-tile :hair="hair"></hair-tile>
                    </router-link>
                    <span class="col-md-12" v-if="hairsfound.length === 0">
                      <i>User has no hairs in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_faces">
                  <div class="row">
                    <router-link :to="'/face/'+face.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="face in facesfound">
                      <face-tile :face="face"></face-tile>
                    </router-link>
                    <span class="col-md-12" v-if="facesfound.length === 0">
                      <i>User has no face in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_nendoroids">
                  <div class="row">
                    <router-link :to="'/nendoroid/'+nendoroid.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroidsfound">
                      <nendoroid-tile :nendoroid="nendoroid"></nendoroid-tile>
                    </router-link>
                    <span class="col-md-12" v-if="nendoroidsfound.length === 0">
                      <i>User has no nendoroid in his favorites right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane active" id="tab_boxes">
                  <div class="row">
                    <router-link :to="'/box/'+box.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="box in boxesfound">
                      <box-tile :box="box"></box-tile>
                    </router-link>
                    <span class="col-md-12" v-if="boxesfound.length === 0">
                      <i>User has no box in his favorites right now...</i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row" v-else>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Not found</h3>
        </div>
        <div class="box-body">
          <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            What you are looking for was not found, please check again the information you enter.
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
  name: 'User',
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
    ...Vuex.mapGetters(['users', 'user', 'canadmin', 'boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hands', 'hairs', 'photos']),
    userid () {
      return this.$route.params.id
    },
    user () {
      return this.users.find(user => user.internalid === this.$route.params.id)
    },
    isself () {
      return this.user.internalid === this.$route.params.id
    },
    boxesfound () {
      return this.boxes.filter(box => box.favusers && box.favusers.findIndex(favuser => favuser.userid === this.userid) !== -1)
    },
    nendoroidsfound () {
      return this.nendoroids.filter(nendoroid => nendoroid.favusers.indexOf(this.userid) !== -1)
    },
    accessoriesfound () {
      return this.accessories.filter(accessory => accessory.favusers && accessory.favusers.findIndex(favuser => favuser.userid === this.userid) !== -1)
    },
    bodypartsfound () {
      return this.bodyparts.filter(bodypart => bodypart.favusers && bodypart.favusers.findIndex(favuser => favuser.userid === this.userid) !== -1)
    },
    facesfound () {
      return this.faces.filter(face => face.favusers && face.favusers.findIndex(favuser => favuser.userid === this.userid) !== -1)
    },
    handsfound () {
      return this.hands.filter(hand => hand.favusers && hand.favusers.findIndex(favuser => favuser.userid === this.userid) !== -1)
    },
    hairsfound () {
      return this.hairs.filter(hair => hair.favusers.indexOf(this.userid) !== -1)
    },
    photosfound () {
      return this.photos.filter(photo => photo.favusers.indexOf(this.userid) !== -1)
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
