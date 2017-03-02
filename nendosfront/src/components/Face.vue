<template>
  <div class="db-box" v-if="face">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-face-internalid">Face {{ face.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="face.colladdeddate" :collquantity="face.collquantity" :validatorname="face.validatorname"></collection-and-validation-tile>

    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Informations" collapsable="true" icon="fa-info"></app-box-header>
          <div class="box-body">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item" v-if="box">
                <b>From box</b>
                <router-link :to="'/box/'+box.internalid" class="pull-right">
                  <div class="db-box-category text-yellow">
                    <span>{{ box.category }}</span>
                    <span v-if="box.number">#{{ box.number }}</span>
                  </div>
                  <div class="db-box-name">{{ box.name }}</div>
                  <div class="db-box-series">{{ box.series }}</div>
                </router-link><br>
              </li>
              <li class="list-group-item" v-if="nendoroid">
                <b>From nendoroid</b>
                <router-link :to="'/nendoroid/'+nendoroid.internalid" class="pull-right">
                  <div class="db-nendoroid-name">{{ nendoroid.name }}</div>
                  <div class="db-nendoroid-version" v-if="nendoroid.version">{{ nendoroid.version }}</div>
                </router-link><br>
              </li>
              <li class="list-group-item" v-if="face.eyes">
                <b>Eyes</b>
                <a class="pull-right">{{ face.eyes }}</a><br>
              </li>
              <li class="list-group-item" v-if="face.eyes_color">
                <b>Eyes color</b>
                <a class="pull-right">{{ face.eyes_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="face.mouth">
                <b>Mouth</b>
                <a class="pull-right">{{ face.mouth }}</a><br>
              </li>
              <li class="list-group-item" v-if="face.skin_color">
                <b>Skin color</b>
                <a class="pull-right">{{ face.skin_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="face.sex">
                <b>Sex</b>
                <a class="pull-right">{{ face.sex }}</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/faces/'+face.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4face.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4face"></photos-tiles>
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
import PhotosTiles from './dblayouts/PhotosTiles'
import CollectionAndValidationTile from './dblayouts/CollectionAndValidationTile'

export default {
  name: 'Face',
  components: {
    AppBoxHeader,
    PhotosTiles,
    CollectionAndValidationTile
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'photos', 'photofaces', 'authenticated', 'viewvalidation']),
    face () {
      return this.faces.filter(face => face.internalid === this.$route.params.id)[0]
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.face.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.face.nendoroidid)[0]
    },
    photo4face () {
      return this.photos.filter(this.filterPhoto)
    }
  },
  methods: {
    filterPhoto (photoObj) {
      return this.photofaces.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
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
