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
          <app-box-header title="User's collection" collapsable="true" icon="fa-cube"></app-box-header>
          <div class="box-body">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li><a href="#tab_accessories"  data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_accessories"></i><span class="label label-warning">{{ accessoriesfound.length}}</span> Accessories </a></li>
                <li><a href="#tab_bodyparts"    data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_body"       ></i><span class="label label-warning">{{ bodypartsfound.length}}</span> Bodyparts   </a></li>
                <li><a href="#tab_hands"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hand"       ></i><span class="label label-warning">{{ handsfound.length}}</span> Hands       </a></li>
                <li><a href="#tab_hairs"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_hair"       ></i><span class="label label-warning">{{ hairsfound.length}}</span> Hairs       </a></li>
                <li><a href="#tab_faces"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_face"       ></i><span class="label label-warning">{{ facesfound.length}}</span> Faces       </a></li>
                <li><a href="#tab_nendoroids"   data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_nendo"      ></i><span class="label label-warning">{{ nendoroidsfound.length}}</span> Nendoroids  </a></li>
                <li class="active"><a href="#tab_boxes"        data-toggle="tab" aria-expanded="true"><i class="fa icon-icon_nendo_boxes"      ></i><span class="label label-warning">{{ boxesfound.length}}</span> Boxes      </a></li>
                <li class="pull-left header">Collection</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="tab_accessories">
                  <div class="row">
                    <router-link :to="'/accessory/'+accessory.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessoriesfound">
                      <accessory-tile :accessory="accessory"></accessory-tile>
                    </router-link>
                    <span class="col-md-12" v-if="accessoriesfound.length === 0">
                      <i>User has no accessory in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_bodyparts">
                  <div class="row">
                    <router-link :to="'/bodypart/'+bodypart.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodypartsfound">
                      <bodypart-tile :bodypart="bodypart"></bodypart-tile>
                    </router-link>
                    <span class="col-md-12" v-if="bodypartsfound.length === 0">
                      <i>User has no bodypart in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_hands">
                  <div class="row">
                    <router-link :to="'/hand/'+hand.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hand in handsfound">
                      <hand-tile :hand="hand"></hand-tile>
                    </router-link>
                    <span class="col-md-12" v-if="handsfound.length === 0">
                      <i>User has no hand in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_hairs">
                  <div class="row">
                    <router-link :to="'/hair/'+hair.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairsfound">
                      <hair-tile :hair="hair"></hair-tile>
                    </router-link>
                    <span class="col-md-12" v-if="hairsfound.length === 0">
                      <i>User has no hairs in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_faces">
                  <div class="row">
                    <router-link :to="'/face/'+face.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="face in facesfound">
                      <face-tile :face="face"></face-tile>
                    </router-link>
                    <span class="col-md-12" v-if="facesfound.length === 0">
                      <i>User has no face in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane" id="tab_nendoroids">
                  <div class="row">
                    <router-link :to="'/nendoroid/'+nendoroid.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroidsfound">
                      <nendoroid-tile :nendoroid="nendoroid"></nendoroid-tile>
                    </router-link>
                    <span class="col-md-12" v-if="nendoroidsfound.length === 0">
                      <i>User has no nendoroid in his collection right now...</i>
                    </span>
                  </div>
                </div>
                <div class="tab-pane active" id="tab_boxes">
                  <div class="row">
                    <router-link :to="'/box/'+box.internalid" class="col-md-2 col-sm-4 col-xs-6" v-for="box in boxesfound">
                      <box-tile :box="box"></box-tile>
                    </router-link>
                    <span class="col-md-12" v-if="boxesfound.length === 0">
                      <i>User has no box in his collection right now...</i>
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

export default {
  name: 'UserCollection',
  components: {
    AppBoxHeader,
    BoxTile,
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
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['users', 'user', 'boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hands', 'hairs']),
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
      return this.boxes.filter(box => box.colusers && box.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    nendoroidsfound () {
      return this.nendoroids.filter(nendoroid => nendoroid.colusers && nendoroid.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    accessoriesfound () {
      return this.accessories.filter(accessory => accessory.colusers && accessory.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    bodypartsfound () {
      return this.bodyparts.filter(bodypart => bodypart.colusers && bodypart.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    facesfound () {
      return this.faces.filter(face => face.colusers && face.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    handsfound () {
      return this.hands.filter(hand => hand.colusers && hand.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
    },
    hairsfound () {
      return this.hairs.filter(hair => hair.colusers && hair.colusers.findIndex(coluser => coluser.userid === this.userid) !== -1)
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
