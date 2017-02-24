<template>
  <div class="db-box" v-if="box.internalid">

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

    <div class="row" v-if="box.colladdeddate">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            You own this box in {{ box.collquantity }} cop{{ box.collquantity > 1 ? 'ies' : 'y' }}
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
              <li class="list-group-item" v-if="box.number">
                <b>Number</b>
                <a class="pull-right">{{ box.number }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.name">
                <b>Name</b>
                <a class="pull-right">{{ box.name }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.series">
                <b>Series</b>
                <a class="pull-right">{{ box.series }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.manufacturer">
                <b>Manufacturer</b>
                <a class="pull-right">{{ box.manufacturer }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.price">
                <b>Price ¥</b>
                <a class="pull-right">{{ box.price }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.category">
                <b>Category</b>
                <a class="pull-right">{{ box.category }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.releasedate">
                <b>Release date</b>
                <a class="pull-right">{{ box.releasedate }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.specifications">
                <b>Specifications</b>
                <a class="pull-right">{{ box.specifications }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.sculptor">
                <b>Sculptor</b>
                <a class="pull-right">{{ box.sculptor }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.cooperation">
                <b>Cooperation</b>
                <a class="pull-right">{{ box.cooperation }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.officialurl">
                <b>Links</b>
                <a class="pull-right" :href="box.officialurl">GSC product page</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/boxes/'+box.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="nendoroids.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Nendoroids" collapsable="true" collapsed="true" icon="icon-icon_nendo_nendo"></app-box-header>
          <div class="box-body">
            <nendoroids-tiles :nendoroids="nendoroids" tilessize="big"></nendoroids-tiles>
          </div>
        </div>
      </div>
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
import NendoroidsTiles from './dblayouts/NendoroidsTiles'
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'
import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Box',
  components: {
    AppBoxHeader,
    NendoroidsTiles,
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
      nendoroids: [],
      faces: [],
      hairs: [],
      hands: [],
      bodyparts: [],
      accessories: [],
      photos: []
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes']),
    box () {
      console.log(this.boxes.filter(box => box.internalid === this.$route.params.id))
      return this.boxes.filter(box => box.internalid === this.$route.params.id)[0]
    }
  },
  methods: {
    ...Vuex.mapActions(['retrieveBox'])
  },
  mounted () {
    // this.$boxes = this.$resource('boxes{/id}')
    this.$nendoroids = this.$resource('boxes{/id}/nendoroids')
    this.$faces = this.$resource('boxes{/id}/faces')
    this.$hairs = this.$resource('boxes{/id}/hairs')
    this.$hands = this.$resource('boxes{/id}/hands')
    this.$bodyparts = this.$resource('boxes{/id}/bodyparts')
    this.$accessories = this.$resource('boxes{/id}/accessories')
    this.$photos = this.$resource('boxes{/id}/photos')

    // this.$boxes.query({id: this.$route.params.id}).then((response) => {
    //   this.box = response.data
    // }, (response) => {
    //   console.log('Error', response)
    // })
    this.$nendoroids.query({id: this.$route.params.id}).then((response) => {
      this.nendoroids = response.data
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
