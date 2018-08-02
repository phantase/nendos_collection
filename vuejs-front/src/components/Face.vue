<template>
  <div class="db-box" v-if="face">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="face.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ face.numberfavorited ? face.numberfavorited : '0' }}</span>
              </button>
              <router-link :to="'/face/'+face.internalid+'/edit'" class="btn btn-xs bg-blue pull-right margin-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link>
              <div class="db-face-internalid">Face {{ face.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="face.colladdeddate"
                                    :collquantity="face.collquantity"
                                    :validatorname="face.validatorname"
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
                <b>Gender</b>
                <a class="pull-right">{{ face.sex }}</a><br>
              </li>
            </ul>
          </div>
        </div>
        <div class="box collapsed-box">
          <app-box-header :title="'Tags ('+(face.tags?face.tags.length:0)+')'" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in face.tags" :key="tag.internalid"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!face.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <auto-suggest placeholder="New tag" :options="facesTagsCodeList" v-model="newTag"></auto-suggest>
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
              :editable="canedit" :editlink="'/face/'+face.internalid+'/edit/image/'+current"
              :otherable="canedit" :otherlink="'/face/'+face.internalid+'/edit/image/'+(face.nbpictures*1+1)" othericon="fa-plus-square-o" othername="Add photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/faces/'+face.internalid+'/'+current+'/thumb'" v-if="face.nbpictures > 0"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
            <div v-if="face.nbpictures > 1" style="text-align:center;">
              <i class="fa fa-chevron-left" style="float:left;" @click="prevPhoto()"></i>
              <span style="text-align:center; font-weight:bold;">{{ face.nbpictures }} photos available</span>
              <i class="fa fa-chevron-right" style="float:right;" @click="nextPhoto()"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4face.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Photos ('+photo4face.length+')'" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4face"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="face.favusers"></favorited-tile>
      <collected-tile :colusers="face.colusers"></collected-tile>
    </div>

    <history-box elementtype="face" :internalid="face.internalid"></history-box>

  </div>
  <div class="row" v-else>
    <div class="col-md-12" v-if="faces.length === 0">
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
import PhotosTiles from './dblayouts/PhotosTiles'
import CollectionAndValidationTile from './dblayouts/CollectionAndValidationTile'
import CollectedTile from './dblayouts/CollectedTile'
import FavoritedTile from './dblayouts/FavoritedTile'
import HistoryBox from './dblayouts/HistoryBox'
import AutoSuggest from './atomic/AutoSuggest'

export default {
  name: 'Face',
  components: {
    AppBoxHeader,
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
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'photos', 'photofaces',
      'authenticated', 'canedit', 'facesTagsCodeList']),
    face () {
      return this.faces.find(face => face.internalid === this.$route.params.id)
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.face.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.face.nendoroidid)[0]
    },
    photo4face () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.face.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['collectFace', 'uncollectFace',
      'validateFace', 'unvalidateFace',
      'favoriteFace', 'unfavoriteFace',
      'tagFace',
      'retrieveSingleFace', 'retrieveBoxesForFace', 'retrieveNendoroidsForFace']),
    filterPhoto (photoObj) {
      return this.photofaces.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      console.log('COLLECT...')
      this.collectFace({
        'context': this,
        'faceid': this.face.internalid
      }).then(() => {
        console.log('Collection successful')
      }, () => {
        console.log('Collection failed')
      })
    },
    uncollect () {
      console.log('UNCOLLECT...')
      this.uncollectFace({
        'context': this,
        'faceid': this.face.internalid
      }).then(() => {
        console.log('UNCollection successful')
      }, () => {
        console.log('UNCollection failed')
      })
    },
    validate () {
      console.log('VALIDATE...')
      this.validateFace({
        'context': this,
        'faceid': this.face.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateFace({
        'context': this,
        'faceid': this.face.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.face.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteFace({
          'context': this,
          'faceid': this.face.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteFace({
          'context': this,
          'faceid': this.face.internalid
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
      this.tagFace({
        'context': this,
        'faceid': this.face.internalid,
        'tag': this.newTag
      }).then(() => {
        console.log('Tag successful')
        this.newTag = []
      }, () => {
        console.log('Tag failed')
      })
    },
    nextPhoto () {
      this.current = (this.current === (this.face.nbpictures * 1)) ? 1 : this.current + 1
    },
    prevPhoto () {
      this.current = (this.current === 1) ? this.face.nbpictures : this.current - 1
    }
  },
  mounted () {
    if (this.faces.length === 0) {
      this.retrieveSingleFace({
        'context': this,
        'faceid': this.$route.params.id
      })
    }
    if (this.boxes.length === 0) {
      this.retrieveBoxesForFace({
        'context': this,
        'faceid': this.$route.params.id
      })
    }
    if (this.nendoroids.length === 0) {
      this.retrieveNendoroidsForFace({
        'context': this,
        'faceid': this.$route.params.id
      })
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.face) {
        document.title += ' / Id: ' + vm.face.internalid
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
