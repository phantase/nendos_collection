<template>
  <div class="home">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/boxes">
          <app-info-box title="Boxes" color="bg-yellow" icon="icon-icon_nendo_boxes" :count="countboxes" :usercount="countuserboxes"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/nendoroids">
          <app-info-box title="Nendoroids" color="bg-yellow" icon="icon-icon_nendo_nendo" :count="countnendoroids" :usercount="countusernendoroids"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/faces">
          <app-info-box title="Faces" color="bg-yellow" icon="icon-icon_nendo_face" :count="countfaces" :usercount="countuserfaces"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hairs">
          <app-info-box title="Hairs" color="bg-yellow" icon="icon-icon_nendo_hair" :count="counthairs" :usercount="countuserhairs"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hands">
          <app-info-box title="Hands" color="bg-yellow" icon="icon-icon_nendo_hand" :count="counthands" :usercount="countuserhands"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/bodyparts">
          <app-info-box title="Bodyparts" color="bg-yellow" icon="icon-icon_nendo_body" :count="countbodyparts" :usercount="countuserbodyparts"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/accessories">
          <app-info-box title="Accessories" color="bg-yellow" icon="icon-icon_nendo_accessories" :count="countaccessories" :usercount="countuseraccessories"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/photos">
          <app-info-box title="Photos" color="bg-yellow" icon="fa-photo" :count="countphotos"></app-info-box>
        </router-link>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="box box-warning">
          <app-box-header title="Latest news" collapsable="true" icon="fa-newspaper-o"></app-box-header>
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <app-news-tile v-for="singleNews in homeNews" :news="singleNews"></app-news-tile>
            </ul>
          </div>
          <div class="box-footer text-center">
            <router-link to="/news" class="uppercase">View all news</router-link>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="box box-warning">
          <app-box-header title="Latest validated elements" collapsable="true" icon="fa-clock-o"></app-box-header>
          <div class="box-body">
            <box-h-tile       :box="latestBox"              v-if="latestElementView % 7 === 0"></box-h-tile>
            <nendoroid-h-tile :nendoroid="latestNendoroid"  v-if="latestElementView % 7 === 1"></nendoroid-h-tile>
            <face-h-tile      :face="latestFace"            v-if="latestElementView % 7 === 2"></face-h-tile>
            <hair-h-tile      :hair="latestHair"            v-if="latestElementView % 7 === 3"></hair-h-tile>
            <hand-h-tile      :hand="latestHand"            v-if="latestElementView % 7 === 4"></hand-h-tile>
            <bodypart-h-tile  :bodypart="latestBodypart"    v-if="latestElementView % 7 === 5"></bodypart-h-tile>
            <accessory-h-tile :accessory="latestAccessory"  v-if="latestElementView % 7 === 6"></accessory-h-tile>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import store from './../store'
  import Vuex from 'vuex'

  import AppBoxHeader from './layouts/BoxHeader'
  import AppInfoBox from './dblayouts/InfoBox'
  import AppNewsTile from './dblayouts/NewsTile'

  import BoxHTile from './dblayouts/BoxHTile'
  import NendoroidHTile from './dblayouts/NendoroidHTile'
  import FaceHTile from './dblayouts/FaceHTile'
  import HairHTile from './dblayouts/HairHTile'
  import HandHTile from './dblayouts/HandHTile'
  import BodypartHTile from './dblayouts/BodypartHTile'
  import AccessoryHTile from './dblayouts/AccessoryHTile'

  export default {
    name: 'Home',
    components: {
      AppBoxHeader,
      AppInfoBox,
      AppNewsTile,
      BoxHTile,
      NendoroidHTile,
      FaceHTile,
      HairHTile,
      HandHTile,
      BodypartHTile,
      AccessoryHTile
    },
    store: store,
    data () {
      return {
        latestElementView: 0
      }
    },
    computed: {
      ...Vuex.mapGetters([
        'countboxes', 'countuserboxes',
        'countnendoroids', 'countusernendoroids',
        'countfaces', 'countuserfaces',
        'counthairs', 'countuserhairs',
        'counthands', 'countuserhands',
        'countbodyparts', 'countuserbodyparts',
        'countaccessories', 'countuseraccessories',
        'countphotos', 'news',
        'boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories'
      ]),
      homeNews () {
        return this.news.concat().sort(function (a, b) {
          return new Date(b.creationdate).getTime() - new Date(a.creationdate).getTime()
        })
      },
      latestBox () {
        return this.boxes.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestNendoroid () {
        return this.nendoroids.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestFace () {
        return this.faces.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestHair () {
        return this.hairs.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestHand () {
        return this.hands.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestBodypart () {
        return this.bodyparts.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      },
      latestAccessory () {
        return this.accessories.concat().sort(function (a, b) {
          return new Date(b.validationdate).getTime() - new Date(a.validationdate).getTime()
        })[0]
      }
    },
    mounted () {
      window.setInterval(() => {
        this.latestElementView ++
      }, 5000)
    }
  }
</script>
