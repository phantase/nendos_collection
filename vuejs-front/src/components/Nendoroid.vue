<template>
  <div class="db-box" v-if="nendoroid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="nendoroid.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ nendoroid.numberfavorited ? nendoroid.numberfavorited : '0' }}</span>
              </button>
              <div class="pull-right margin-right">
                <div><router-link :to="'/nendoroid/'+nendoroid.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link></div>
                <div style="margin-top:5px;"><router-link :to="'/nendoroid/'+nendoroid.internalid+'/addpart'" class="btn btn-xs bg-orange pull-right" v-if="canedit"><i class="fa fa-plus"></i> Add a part</router-link></div>
              </div>
              <div class="db-nendoroid-name">{{ nendoroid.name }}</div>
              <div class="db-nendoroid-version">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="nendoroid.colladdeddate"
                                    :collquantity="nendoroid.collquantity"
                                    :validatorname="nendoroid.validatorname"
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
              <li class="list-group-item" v-if="box">
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
                <b>Gender</b>
                <a class="pull-right">{{ nendoroid.sex }}</a><br>
              </li>
            </ul>
          </div>
        </div>
        <div class="box collapsed-box">
          <app-box-header :title="'Tags ('+(nendoroid.tags?nendoroid.tags.length:0)+')'" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in nendoroid.tags" :key="tag.internalid"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!nendoroid.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <auto-suggest placeholder="New tag" :options="nendoroidsTagsCodeList" v-model="newTag"></auto-suggest>
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
              :editable="canedit" :editlink="'/nendoroid/'+nendoroid.internalid+'/edit/image/'+current"
              :otherable="canedit" :otherlink="'/nendoroid/'+nendoroid.internalid+'/edit/image/'+(nendoroid.nbpictures*1+1)" othericon="fa-plus-square-o" othername="Add photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/nendoroids/'+nendoroid.internalid+'/'+current+'/thumb'" v-if="nendoroid.nbpictures > 0"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
            <div v-if="nendoroid.nbpictures > 1" style="text-align:center;">
              <i class="fa fa-chevron-left" style="float:left;" @click="prevPhoto()"></i>
              <span style="text-align:center; font-weight:bold;">{{ nendoroid.nbpictures }} photos available</span>
              <i class="fa fa-chevron-right" style="float:right;" @click="nextPhoto()"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Faces ('+faces4nendoroid.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces4nendoroid" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hairs ('+hairs4nendoroid.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs4nendoroid" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hands ('+hands4nendoroid.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands4nendoroid" tilessize="big"></hands-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Bodyparts ('+bodyparts4nendoroid.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts4nendoroid" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Accessories ('+accessories4nendoroid.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories4nendoroid" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4nendoroid.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Photos ('+photo4nendoroid.length+')'" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4nendoroid"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="nendoroid.favusers"></favorited-tile>
      <collected-tile :colusers="nendoroid.colusers"></collected-tile>
    </div>

    <history-box elementtype="nendoroid" :internalid="nendoroid.internalid"></history-box>

  </div>
  <div class="row" v-else>
    <div class="col-md-12" v-if="nendoroids.length === 0">
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

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
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
  name: 'Nendoroid',
  components: {
    AppBoxHeader,
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
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos', 'photonendoroids',
      'authenticated', 'canedit', 'nendoroidsTagsCodeList']),
    nendoroid () {
      return this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.id)
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.nendoroid.boxid)[0]
    },
    faces4nendoroid () {
      return this.faces.filter(face => face.nendoroidid === this.$route.params.id)
    },
    hairs4nendoroid () {
      return this.hairs.filter(hair => hair.nendoroidid === this.$route.params.id)
    },
    hands4nendoroid () {
      return this.hands.filter(hand => hand.nendoroidid === this.$route.params.id)
    },
    bodyparts4nendoroid () {
      return this.bodyparts.filter(bodypart => bodypart.nendoroidid === this.$route.params.id)
    },
    accessories4nendoroid () {
      return this.accessories.filter(accessory => accessory.nendoroidid === this.$route.params.id)
    },
    photo4nendoroid () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.nendoroid.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['collectNendoroid', 'uncollectNendoroid',
      'validateNendoroid', 'unvalidateNendoroid',
      'favoriteNendoroid', 'unfavoriteNendoroid',
      'tagNendoroid',
      'retrieveSingleNendoroid', 'retrieveBoxesForNendoroid',
      'retrieveAccessoriesForNendoroid', 'retrieveBodypartsForNendoroid', 'retrieveFacesForNendoroid', 'retrieveHairsForNendoroid', 'retrieveHandsForNendoroid']),
    filterPhoto (photoObj) {
      return this.photonendoroids.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      console.log('COLLECT...')
      this.collectNendoroid({
        'context': this,
        'nendoroidid': this.nendoroid.internalid
      }).then(() => {
        console.log('Collection successful')
      }, () => {
        console.log('Collection failed')
      })
    },
    uncollect () {
      console.log('UNCOLLECT...')
      this.uncollectNendoroid({
        'context': this,
        'nendoroidid': this.nendoroid.internalid
      }).then(() => {
        console.log('UNCollection successful')
      }, () => {
        console.log('UNCollection failed')
      })
    },
    validate () {
      console.log('VALIDATE...')
      this.validateNendoroid({
        'context': this,
        'nendoroidid': this.nendoroid.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateNendoroid({
        'context': this,
        'nendoroidid': this.nendoroid.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.nendoroid.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteNendoroid({
          'context': this,
          'nendoroidid': this.nendoroid.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteNendoroid({
          'context': this,
          'nendoroidid': this.nendoroid.internalid
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
      this.tagNendoroid({
        'context': this,
        'nendoroidid': this.nendoroid.internalid,
        'tag': this.newTag
      }).then(() => {
        console.log('Tag successful')
        this.newTag = []
      }, () => {
        console.log('Tag failed')
      })
    },
    nextPhoto () {
      this.current = (this.current === (this.nendoroid.nbpictures * 1)) ? 1 : this.current + 1
    },
    prevPhoto () {
      this.current = (this.current === 1) ? this.nendoroid.nbpictures : this.current - 1
    }
  },
  mounted () {
    if (this.nendoroids.length === 0) {
      this.retrieveSingleNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.boxes.length === 0) {
      this.retrieveBoxesForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.accessories.length === 0) {
      this.retrieveAccessoriesForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.bodyparts.length === 0) {
      this.retrieveBodypartsForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.faces.length === 0) {
      this.retrieveFacesForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.hairs.length === 0) {
      this.retrieveHairsForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
    if (this.hands.length === 0) {
      this.retrieveHandsForNendoroid({
        'context': this,
        'nendoroidid': this.$route.params.id
      })
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.nendoroid) {
        document.title += ' / ' + vm.nendoroid.name + (vm.nendoroid.version ? ' / ' + vm.nendoroid.version : '')
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
  .tags span {
    margin-left: 3px;
  }
</style>
