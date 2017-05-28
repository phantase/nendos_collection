<template>
  <div class="db-box" v-if="box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="box.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click.once="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ box.numberfavorited ? box.numberfavorited : '0' }}</span>
              </button>
              <div class="pull-right margin-right">
                <div><router-link :to="'/box/'+box.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link></div>
                <div style="margin-top:5px;"><router-link :to="'/box/'+box.internalid+'/addpart'" class="btn btn-xs bg-orange pull-right" v-if="canedit"><i class="fa fa-plus"></i> Add a part</router-link></div>
              </div>
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

    <collection-and-validation-tile :colladdeddate="box.colladdeddate"
                                    :collquantity="box.collquantity"
                                    :validatorname="box.validatorname"
                                    v-on:collect="collect"
                                    v-on:uncollect="uncollect"
                                    v-on:validate="validate"
                                    v-on:unvalidate="unvalidate"></collection-and-validation-tile>

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
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canedit" :editlink="'/box/'+box.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.apiurl+'/images/boxes/'+box.internalid+'/thumb'" v-if="box.haspicture == '1'"/>
            <img :src="resources.apiurl+'/images/unknown'" v-else />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="nendoroids4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Nendoroids" collapsable="true" collapsed="true" icon="icon-icon_nendo_nendo"></app-box-header>
          <div class="box-body">
            <nendoroids-tiles :nendoroids="nendoroids4box" tilessize="big"></nendoroids-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Faces" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces4box" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hairs" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs4box" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hands" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands4box" tilessize="big"></hands-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Bodyparts" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts4box" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Accessories" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories4box" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4box"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <history-box elementtype="box" :internalid="box.internalid"></history-box>

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

import router from './../router'
import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'
import PhotosTiles from './dblayouts/PhotosTiles'
import CollectionAndValidationTile from './dblayouts/CollectionAndValidationTile'
import HistoryBox from './dblayouts/HistoryBox'

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
    PhotosTiles,
    CollectionAndValidationTile,
    HistoryBox
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos', 'photoboxes', 'authenticated', 'viewvalidation', 'canedit']),
    box () {
      return this.boxes.find(box => box.internalid === this.$route.params.id)
    },
    nendoroids4box () {
      return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.$route.params.id)
    },
    faces4box () {
      return this.faces.filter(face => face.boxid === this.$route.params.id)
    },
    hairs4box () {
      return this.hairs.filter(hair => hair.boxid === this.$route.params.id)
    },
    hands4box () {
      return this.hands.filter(hand => hand.boxid === this.$route.params.id)
    },
    bodyparts4box () {
      return this.bodyparts.filter(bodypart => bodypart.boxid === this.$route.params.id)
    },
    accessories4box () {
      return this.accessories.filter(accessory => accessory.boxid === this.$route.params.id)
    },
    photo4box () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.box.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['validateBox', 'unvalidateBox', 'favoriteBox', 'unfavoriteBox']),
    filterPhoto (photoObj) {
      return this.photoboxes.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      router.push('/box/' + this.$route.params.id + '/collect')
    },
    uncollect () {
      router.push('/box/' + this.$route.params.id + '/uncollect')
    },
    validate () {
      console.log('VALIDATE...')
      this.validateBox({
        'context': this,
        'boxid': this.box.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateBox({
        'context': this,
        'boxid': this.box.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.box.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteBox({
          'context': this,
          'boxid': this.box.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteBox({
          'context': this,
          'boxid': this.box.internalid
        }).then(() => {
          console.log('Favorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('Favorite failed')
        })
      }
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
  .margin-right {
    margin-right: 5px;
  }
</style>
