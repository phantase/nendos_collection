<template>
  <div class="db-box" v-if="hair">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-face-internalid">Hair {{ hair.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="authenticated || viewvalidation">
      <div :class="viewvalidation?'col-md-6':'col-md-12'">
        <div class="box">
          <div class="box-body">
            <span v-if="hair.colladdeddate">
              You own this hair in {{ hair.collquantity }} cop{{ hair.collquantity > 1 ? 'ies' : 'y' }}
            </span>
            <span v-else>
              <a href="#">Add hair to collection</a>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-6" v-if="viewvalidation">
        <div class="box">
          <div class="box-body">
            <span v-if="hair.validatorname">Validated by <i>{{hair.validatorname}}</i></span>
            <span v-else>Not validated</span>
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
              <li class="list-group-item" v-if="hair.haircut">
                <b>Haircut</b>
                <a class="pull-right">{{ hair.haircut }}</a><br>
              </li>
              <li class="list-group-item" v-if="hair.frontback">
                <b>Front/Back</b>
                <a class="pull-right">{{ hair.frontback }}</a><br>
              </li>
              <li class="list-group-item" v-if="hair.main_color">
                <b>Main color</b>
                <a class="pull-right">{{ hair.main_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="hair.other_color">
                <b>Other color</b>
                <a class="pull-right">{{ hair.other_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="hair.description">
                <b>Description</b>
                <a class="pull-right">{{ hair.description }}</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/hairs/'+hair.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4hair.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4hair"></photos-tiles>
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

export default {
  name: 'Hair',
  components: {
    AppBoxHeader,
    PhotosTiles
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'hairs', 'photos', 'photohairs', 'authenticated', 'viewvalidation']),
    hair () {
      return this.hairs.filter(hair => hair.internalid === this.$route.params.id)[0]
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.hair.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.hair.nendoroidid)[0]
    },
    photo4hair () {
      return this.photos.filter(this.filterPhoto)
    }
  },
  methods: {
    filterPhoto (photoObj) {
      return this.photohairs.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
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
