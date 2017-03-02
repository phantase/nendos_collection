<template>
  <div class="db-box" v-if="accessory">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-accessory-internalid">Accessory {{ accessory.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="accessory.colladdeddate" :collquantity="accessory.collquantity" :validatorname="accessory.validatorname"></collection-and-validation-tile>

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
              <li class="list-group-item" v-if="accessory.type">
                <b>Type</b>
                <a class="pull-right">{{ accessory.type }}</a><br>
              </li>
              <li class="list-group-item" v-if="accessory.main_color">
                <b>Main color</b>
                <a class="pull-right">{{ accessory.main_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="accessory.other_color">
                <b>Other color</b>
                <a class="pull-right">{{ accessory.other_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="accessory.description">
                <b>Description</b>
                <a class="pull-right">{{ accessory.description }}</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/accessories/'+accessory.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photos4accessory.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photos4accessory"></photos-tiles>
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
  name: 'Accessory',
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
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'photos', 'photoaccessories', 'authenticated', 'viewvalidation']),
    accessory () {
      return this.accessories.filter(accessory => accessory.internalid === this.$route.params.id)[0]
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.accessory.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.accessory.nendoroidid)[0]
    },
    photos4accessory () {
      return this.photos.filter(this.filterPhoto)
    }
  },
  methods: {
    filterPhoto (photoObj) {
      return this.photoaccessories.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
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
