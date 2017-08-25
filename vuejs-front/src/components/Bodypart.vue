<template>
  <div class="db-box" v-if="bodypart">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="bodypart.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ bodypart.numberfavorited ? bodypart.numberfavorited : '0' }}</span>
              </button>
              <router-link :to="'/bodypart/'+bodypart.internalid+'/edit'" class="btn btn-xs bg-blue pull-right margin-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link>
              <div class="db-bodypart-internalid">Bodypart {{ bodypart.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="bodypart.colladdeddate"
                                    :collquantity="bodypart.collquantity"
                                    :validatorname="bodypart.validatorname"
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
              <li class="list-group-item" v-if="bodypart.part">
                <b>Part</b>
                <a class="pull-right">{{ bodypart.part }}</a><br>
              </li>
              <li class="list-group-item" v-if="bodypart.main_color">
                <b>Main color</b>
                <a class="pull-right">{{ bodypart.main_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="bodypart.other_color">
                <b>Other color</b>
                <a class="pull-right">{{ bodypart.other_color }}</a><br>
              </li>
              <li class="list-group-item" v-if="bodypart.description">
                <b>Description</b>
                <a class="pull-right">{{ bodypart.description }}</a><br>
              </li>
            </ul>
          </div>
        </div>
        <div class="box collapsed-box">
          <app-box-header title="Tags" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in bodypart.tags"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!bodypart.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <select2 placeholder="New tag" :options="bodypartsTagsCodeList" v-model="newTag"></select2>
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
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canedit" :editlink="'/bodypart/'+bodypart.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/bodyparts/'+bodypart.internalid+'/thumb'"  v-if="bodypart.haspicture == '1'"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photo4bodypart.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photo4bodypart"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="bodypart.favusers"></favorited-tile>
      <collected-tile :colusers="bodypart.colusers"></collected-tile>
    </div>

    <history-box elementtype="bodypart" :internalid="bodypart.internalid"></history-box>

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

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import PhotosTiles from './dblayouts/PhotosTiles'
import CollectionAndValidationTile from './dblayouts/CollectionAndValidationTile'
import CollectedTile from './dblayouts/CollectedTile'
import FavoritedTile from './dblayouts/FavoritedTile'
import HistoryBox from './dblayouts/HistoryBox'
import Select2 from './atomic/Select2'

export default {
  name: 'Bodypart',
  components: {
    AppBoxHeader,
    PhotosTiles,
    CollectionAndValidationTile,
    CollectedTile,
    FavoritedTile,
    HistoryBox,
    Select2
  },
  store: store,
  data () {
    return {
      resources: Resources,
      addTag: false,
      newTag: []
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'bodyparts', 'photos', 'photobodyparts', 'authenticated', 'viewvalidation', 'canedit', 'bodypartsTagsCodeList']),
    bodypart () {
      return this.bodyparts.find(bodypart => bodypart.internalid === this.$route.params.id)
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.bodypart.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.bodypart.nendoroidid)[0]
    },
    photo4bodypart () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.bodypart.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['collectBodypart', 'uncollectBodypart', 'validateBodypart', 'unvalidateBodypart', 'favoriteBodypart', 'unfavoriteBodypart', 'tagBodypart']),
    filterPhoto (photoObj) {
      return this.photobodyparts.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      console.log('COLLECT...')
      this.collectBodypart({
        'context': this,
        'bodypartid': this.bodypart.internalid
      }).then(() => {
        console.log('Collection successful')
      }, () => {
        console.log('Collection failed')
      })
    },
    uncollect () {
      console.log('UNCOLLECT...')
      this.uncollectBodypart({
        'context': this,
        'bodypartid': this.bodypart.internalid
      }).then(() => {
        console.log('UNCollection successful')
      }, () => {
        console.log('UNCollection failed')
      })
    },
    validate () {
      console.log('VALIDATE...')
      this.validateBodypart({
        'context': this,
        'bodypartid': this.bodypart.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateBodypart({
        'context': this,
        'bodypartid': this.bodypart.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.bodypart.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteBodypart({
          'context': this,
          'bodypartid': this.bodypart.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteBodypart({
          'context': this,
          'bodypartid': this.bodypart.internalid
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
      this.tagBodypart({
        'context': this,
        'bodypartid': this.bodypart.internalid,
        'tag': this.newTag
      }).then(() => {
        console.log('Tag successful')
        this.newTag = []
      }, () => {
        console.log('Tag failed')
      })
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.bodypart) {
        document.title += ' / ' + vm.bodypart.part + ' / Id: ' + vm.bodypart.internalid
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
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s
  }
  .fade-enter, .fade-leave-to {
    opacity: 0
  }
</style>
