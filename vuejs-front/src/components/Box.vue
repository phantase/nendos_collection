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
                      @click="doFavorite">
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
        <div class="box collapsed-box">
          <app-box-header :title="'Tags ('+(box.tags?box.tags.length:0)+')'" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in box.tags" :key="tag.internalid"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!box.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <auto-suggest placeholder="New tag" :options="boxesTagsCodeList" v-model="newTag"></auto-suggest>
                  </div>
                  <div class="col-md-4">
                    <button class="btn" @click="tag">Add this tag</button>
                  </div>
                </div>
              </div>
            </transition>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" 
              :editable="canedit" :editlink="'/box/'+box.internalid+'/edit/image/'+current"
              :otherable="canedit" :otherlink="'/box/'+box.internalid+'/edit/image/'+(box.nbpictures*1+1)" othericon="fa-plus-square-o" othername="Add photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/boxes/'+box.internalid+'/'+current+'/thumb'" v-if="box.nbpictures > 0"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
            <div v-if="box.nbpictures > 1" style="text-align:center;">
              <i class="fa fa-chevron-left" style="float:left;" @click="prevPhoto()"></i>
              <span style="text-align:center; font-weight:bold;">{{ box.nbpictures }} photos available</span>
              <i class="fa fa-chevron-right" style="float:right;" @click="nextPhoto()"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="nendoroids4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Nendoroids ('+nendoroids4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_nendo"></app-box-header>
          <div class="box-body">
            <nendoroids-tiles :nendoroids="nendoroids4box" tilessize="big"></nendoroids-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Faces ('+faces4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces4box" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hairs ('+hairs4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs4box" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hands ('+hands4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands4box" tilessize="big"></hands-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Bodyparts ('+bodyparts4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts4box" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Accessories ('+accessories4box.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories4box" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4box.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Photos ('+photo4box.length+')'" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4box"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="box.favusers"></favorited-tile>
      <collected-tile :colusers="box.colusers"></collected-tile>
    </div>

    <history-box elementtype="box" :internalid="box.internalid"></history-box>

  </div>
  <div class="row" v-else>
    <div class="col-md-12" v-if="boxes.length === 0">
      <div class="callout callout-info">
        <h4><i class="icon fa fa-hourglass-half"></i> Loading...</h4>
        <p>Please wait while we load the information for you.</p>
      </div>
    </div>
    <div class="col-md-12" v-else>
      <div class="callout callout-danger">
        <h4><i class="icon fa fa-ban"></i> Not found</h4>
        <p>What you are looking for was not found, please perform another request.</p>
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
import CollectedTile from './dblayouts/CollectedTile'
import FavoritedTile from './dblayouts/FavoritedTile'
import HistoryBox from './dblayouts/HistoryBox'
import AutoSuggest from './atomic/AutoSuggest'

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
    CollectedTile,
    FavoritedTile,
    HistoryBox,
    AutoSuggest
  },
  store: store,
  data () {
    return {
      resources: Resources,
      addTag: false,
      newTag: [],
      current: 1
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos', 'photoboxes',
      'authenticated', 'canedit', 'boxesTagsCodeList']),
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
    ...Vuex.mapActions(['validateBox', 'unvalidateBox',
      'favoriteBox', 'unfavoriteBox',
      'tagBox',
      'retrieveSingleBox', 'retrieveNendoroidsForBox',
      'retrieveAccessoriesForBox', 'retrieveBodypartsForBox', 'retrieveFacesForBox', 'retrieveHairsForBox', 'retrieveHandsForBox']),
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
    },
    tag () {
      console.log('TAG...')
      this.tagBox({
        'context': this,
        'boxid': this.box.internalid,
        'tag': this.newTag
      }).then(() => {
        console.log('Tag successful')
        this.newTag = []
      }, () => {
        console.log('Tag failed')
      })
    },
    nextPhoto () {
      this.current = (this.current === (this.box.nbpictures * 1)) ? 1 : this.current + 1
    },
    prevPhoto () {
      this.current = (this.current === 1) ? this.box.nbpictures : this.current - 1
    }
  },
  mounted () {
    if (this.boxes.length === 0) {
      this.retrieveSingleBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.nendoroids.length === 0) {
      this.retrieveNendoroidsForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.accessories.length === 0) {
      this.retrieveAccessoriesForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.bodyparts.length === 0) {
      this.retrieveBodypartsForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.faces.length === 0) {
      this.retrieveFacesForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.hairs.length === 0) {
      this.retrieveHairsForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
    if (this.hands.length === 0) {
      this.retrieveHandsForBox({
        'context': this,
        'boxid': this.$route.params.id
      })
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.box) {
        document.title += ' / ' + vm.box.category + ' / ' + (vm.box.number ? vm.box.category + ' #' + vm.box.number + ' - ' : '') + vm.box.name + (vm.box.series ? ' - ' + vm.box.series : '')
      } else {
        document.title += ' / Id: ' + vm.$route.params.id
      }
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
  .margin-right {
    margin-right: 5px;
  }
</style>
