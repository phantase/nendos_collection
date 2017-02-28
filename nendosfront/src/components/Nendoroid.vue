<template>
  <div class="db-box" v-if="nendoroid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-nendoroid-name">{{ nendoroid.name }}</div>
              <div class="db-nendoroid-version">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="nendoroid.colladdeddate">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            You own this nendoroid in {{ nendoroid.collquantity }} cop{{ nendoroid.collquantity > 1 ? 'ies' : 'y' }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Informations" collapsable="true" icon="fa-info"></app-box-header>
          <div class="box-body">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item" v-if="box.internalid">
                <b>From box</b>
                <router-link :to="'/box/'+box.internalid" class="pull-right">
                  <div class="db-box-category text-yellow">
                    <span>{{ box.category}}</span>
                    <span v-if="box.number">#{{ box.number}}</span>
                  </div>
                  <div class="db-box-name">{{ box.name }}</div>
                  <div class="db-box-series">{{ box.series }}</div>
                </router-link><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.name">
                <b>Name</b>
                <a class="pull-right">{{ nendoroid.name }}</a><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.version">
                <b>Version</b>
                <a class="pull-right">{{ nendoroid.version }}</a><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.sex">
                <b>Sex</b>
                <a class="pull-right">{{ nendoroid.sex }}</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Faces" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hairs" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hands" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Bodyparts" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Accessories" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photos.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photos"></photos-tiles>
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
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'
import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Nendoroid',
  components: {
    AppBoxHeader,
    FacesTiles,
    HairsTiles,
    HandsTiles,
    BodypartsTiles,
    AccessoriesTiles,
    PhotosTiles
  },
  store: store,
  data () {
    return {
      resources: Resources,
      box: [],
      faces: [],
      hairs: [],
      hands: [],
      bodyparts: [],
      accessories: [],
      photos: []
    }
  },
  computed: {
    ...Vuex.mapGetters(['nendoroids']),
    nendoroid () {
      console.log(this.nendoroids.filter(nendoroid => nendoroid.internalid === this.$route.params.id))
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.$route.params.id)[0]
    }
  },
  mounted () {
    this.$boxes = this.$resource('nendoroids{/id}/boxes')
    this.$faces = this.$resource('nendoroids{/id}/faces')
    this.$hairs = this.$resource('nendoroids{/id}/hairs')
    this.$hands = this.$resource('nendoroids{/id}/hands')
    this.$bodyparts = this.$resource('nendoroids{/id}/bodyparts')
    this.$accessories = this.$resource('nendoroids{/id}/accessories')
    this.$photos = this.$resource('nendoroids{/id}/photos')

    this.$boxes.query({id: this.$route.params.id}).then((response) => {
      this.box = response.data[0]
    }, (response) => {
      console.log('Error', response)
    })
    this.$faces.query({id: this.$route.params.id}).then((response) => {
      this.faces = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$hairs.query({id: this.$route.params.id}).then((response) => {
      this.hairs = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$hands.query({id: this.$route.params.id}).then((response) => {
      this.hands = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$bodyparts.query({id: this.$route.params.id}).then((response) => {
      this.bodyparts = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$accessories.query({id: this.$route.params.id}).then((response) => {
      this.accessories = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$photos.query({id: this.$route.params.id}).then((response) => {
      this.photos = response.data
    }, (response) => {
      console.log('Error', response)
    })
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
