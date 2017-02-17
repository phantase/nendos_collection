<template>
  <div class="db-box" v-if="photo.internalid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-photo-title">{{ photo.title }}</div>
              <div class="db-photo-username">by {{ photo.username }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/photos/'+photo.internalid+'_full'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="boxes.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Boxes" collapsable="true" collapsed="true" icon="icon-icon_nendo_box"></app-box-header>
          <div class="box-body">
            <boxes-tiles :boxes="boxes" tilessize="big"></boxes-tiles>
          </div>
        </div>
      </div>
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
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'
import AppBoxHeader from './layouts/BoxHeader'
import BoxesTiles from './dblayouts/BoxesTiles'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'

export default {
  name: 'Photo',
  components: {
    AppBoxHeader,
    BoxesTiles,
    NendoroidsTiles,
    FacesTiles,
    HairsTiles,
    HandsTiles,
    BodypartsTiles,
    AccessoriesTiles
  },
  data () {
    return {
      resources: Resources,
      photo: [],
      boxes: [],
      nendoroids: [],
      faces: [],
      hairs: [],
      hands: [],
      bodyparts: [],
      accessories: []
    }
  },
  mounted () {
    this.$photos = this.$resource('photos{/id}')
    this.$boxes = this.$resource('photos{/id}/boxes')
    this.$nendoroids = this.$resource('photos{/id}/nendoroids')
    this.$faces = this.$resource('photos{/id}/faces')
    this.$hairs = this.$resource('photos{/id}/hairs')
    this.$hands = this.$resource('photos{/id}/hands')
    this.$bodyparts = this.$resource('photos{/id}/bodyparts')
    this.$accessories = this.$resource('photos{/id}/accessories')

    this.$photos.query({id: this.$route.params.id}).then((response) => {
      this.photo = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$boxes.query({id: this.$route.params.id}).then((response) => {
      this.boxes = response.data
    }, (response) => {
      console.log('Error', response)
    })
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
