<template>
  <div class="db-box" v-if="accessory">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="accessory.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ accessory.numberfavorited ? accessory.numberfavorited : '0' }}</span>
              </button>
              <router-link :to="'/accessory/'+accessory.internalid+'/edit'" class="btn btn-xs bg-blue pull-right margin-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link>
              <div class="db-accessory-internalid">Accessory {{ accessory.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="accessory.colladdeddate"
                                    :collquantity="accessory.collquantity"
                                    :validatorname="accessory.validatorname"
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
        <div class="box collapsed-box">
          <app-box-header :title="'Tags ('+(accessory.tags?accessory.tags.length:0)+')'" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in accessory.tags" :key="tag.internalid"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!accessory.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <select2 placeholder="New tag" :options="accessoriesTagsCodeList" v-model="newTag"></select2>
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
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canedit" :editlink="'/accessory/'+accessory.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/accessories/'+accessory.internalid+'/thumb'"  v-if="accessory.haspicture == '1'"/>
            <img :src="resources.img_url+'/images/unknown'" v-else />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photos4accessory.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Photos ('+photos4accessory.length+')'" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photos4accessory"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="accessory.favusers"></favorited-tile>
      <collected-tile :colusers="accessory.colusers"></collected-tile>
    </div>

    <history-box elementtype="accessory" :internalid="accessory.internalid"></history-box>

  </div>
  <div class="row" v-else>
    <div class="col-md-12" v-if="accessories.length === 0">
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
import FavoritedTile from './dblayouts/FavoritedTile'
import CollectedTile from './dblayouts/CollectedTile'
import HistoryBox from './dblayouts/HistoryBox'
import Select2 from './atomic/Select2'

export default {
  name: 'Accessory',
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
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'photos', 'photoaccessories',
      'authenticated', 'canedit', 'accessoriesTagsCodeList']),
    accessory () {
      return this.accessories.find(accessory => accessory.internalid === this.$route.params.id)
    },
    box () {
      return this.boxes.find(box => box.internalid === this.accessory.boxid)
    },
    nendoroid () {
      return this.nendoroids.find(nendoroid => nendoroid.internalid === this.accessory.nendoroidid)
    },
    photos4accessory () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.accessory.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['collectAccessory', 'uncollectAccessory',
      'validateAccessory', 'unvalidateAccessory',
      'favoriteAccessory', 'unfavoriteAccessory',
      'tagAccessory',
      'retrieveSingleAccessory', 'retrieveBoxesForAccessory', 'retrieveNendoroidsForAccessory']),
    filterPhoto (photoObj) {
      return this.photoaccessories.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      console.log('COLLECT...')
      this.collectAccessory({
        'context': this,
        'accessoryid': this.accessory.internalid
      }).then(() => {
        console.log('Collection successful')
      }, () => {
        console.log('Collection failed')
      })
    },
    uncollect () {
      console.log('UNCOLLECT...')
      this.uncollectAccessory({
        'context': this,
        'accessoryid': this.accessory.internalid
      }).then(() => {
        console.log('UNCollection successful')
      }, () => {
        console.log('UNCollection failed')
      })
    },
    validate () {
      console.log('VALIDATE...')
      this.validateAccessory({
        'context': this,
        'accessoryid': this.accessory.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateAccessory({
        'context': this,
        'accessoryid': this.accessory.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.accessory.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteAccessory({
          'context': this,
          'accessoryid': this.accessory.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteAccessory({
          'context': this,
          'accessoryid': this.accessory.internalid
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
      this.tagAccessory({
        'context': this,
        'accessoryid': this.accessory.internalid,
        'tag': this.newTag
      }).then(() => {
        console.log('Tag successful')
        this.newTag = []
      }, () => {
        console.log('Tag failed')
      })
    }
  },
  mounted () {
    if (this.accessories.length === 0) {
      this.retrieveSingleAccessory({
        'context': this,
        'accessoryid': this.$route.params.id
      })
    }
    if (this.boxes.length === 0) {
      this.retrieveBoxesForAccessory({
        'context': this,
        'accessoryid': this.$route.params.id
      })
    }
    if (this.nendoroids.length === 0) {
      this.retrieveNendoroidsForAccessory({
        'context': this,
        'accessoryid': this.$route.params.id
      })
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      if (vm.accessory) {
        document.title += ' / ' + vm.accessory.type + ' / Id: ' + vm.accessory.internalid
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
