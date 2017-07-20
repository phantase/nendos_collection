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
            <div class="latestElement">
              <transition name="slide">
                <box-h-tile       :box="latestBox"              v-if="latestBox && latestElementView % 7 === 0" key="box"></box-h-tile>
                <nendoroid-h-tile :nendoroid="latestNendoroid"  v-if="latestNendoroid && latestElementView % 7 === 1" key="nendoroid"></nendoroid-h-tile>
                <face-h-tile      :face="latestFace"            v-if="latestFace && latestElementView % 7 === 2" key="face"></face-h-tile>
                <hair-h-tile      :hair="latestHair"            v-if="latestHair && latestElementView % 7 === 3" key="hair"></hair-h-tile>
                <hand-h-tile      :hand="latestHand"            v-if="latestHand && latestElementView % 7 === 4" key="hand"></hand-h-tile>
                <bodypart-h-tile  :bodypart="latestBodypart"    v-if="latestBodypart && latestElementView % 7 === 5" key="bodypart"></bodypart-h-tile>
                <accessory-h-tile :accessory="latestAccessory"  v-if="latestAccessory && latestElementView % 7 === 6" key="accessory"></accessory-h-tile>
              </transition>
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
        latestElementView: 0,
        latestElementInterval: null
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
      this.latestElementInterval = window.setInterval(() => {
        this.latestElementView ++
      }, 5000)
    },
    beforeDestroy () {
      window.clearInterval(this.latestElementInterval)
      this.latestElementInterval = null
    }
  }
</script>

<style scoped>
.latestElement {
  overflow: hidden;
  position: relative;
  height: 100px; /* this is a maginc number */
  width: 100%;
}
.latestElement a {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

.slide-leave-active,
.slide-enter-active {
  transition: transform 1.5s;
}
.slide-enter {
  transform: translate(103%, 0);
}
.slide-leave-to {
  transform:  translate(-103%, 0);
}
</style>
