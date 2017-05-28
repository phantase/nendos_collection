<template>
  <div class="db-box" v-if="hair">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="hair.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click.once="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ hair.numberfavorited ? hair.numberfavorited : '0' }}</span>
              </button>
              <router-link :to="'/hair/'+hair.internalid+'/edit'" class="btn btn-xs bg-blue pull-right margin-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link>
              <div class="db-face-internalid">Hair {{ hair.internalid }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <collection-and-validation-tile :colladdeddate="hair.colladdeddate"
                                    :collquantity="hair.collquantity"
                                    :validatorname="hair.validatorname"
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
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" :editable="canedit" :editlink="'/hair/'+hair.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.apiurl+'/images/hairs/'+hair.internalid+'/thumb'" v-if="hair.haspicture == '1'"/>
            <img :src="resources.apiurl+'/images/unknown'" v-else />
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

    <history-box elementtype="hair" :internalid="hair.internalid"></history-box>

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
import HistoryBox from './dblayouts/HistoryBox'

export default {
  name: 'Hair',
  components: {
    AppBoxHeader,
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
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'hairs', 'photos', 'photohairs', 'authenticated', 'viewvalidation', 'canedit']),
    hair () {
      return this.hairs.find(hair => hair.internalid === this.$route.params.id)
    },
    box () {
      return this.boxes.filter(box => box.internalid === this.hair.boxid)[0]
    },
    nendoroid () {
      return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.hair.nendoroidid)[0]
    },
    photo4hair () {
      return this.photos.filter(this.filterPhoto)
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.hair.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['collectHair', 'uncollectHair', 'validateHair', 'unvalidateHair', 'favoriteHair', 'unfavoriteHair']),
    filterPhoto (photoObj) {
      return this.photohairs.filter(pe => (pe.photoid === photoObj.internalid && pe.elementid === this.$route.params.id)).length > 0
    },
    collect () {
      console.log('COLLECT...')
      this.collectHair({
        'context': this,
        'hairid': this.hair.internalid
      }).then(() => {
        console.log('Collection successful')
      }, () => {
        console.log('Collection failed')
      })
    },
    uncollect () {
      console.log('UNCOLLECT...')
      this.uncollectHair({
        'context': this,
        'hairid': this.hair.internalid
      }).then(() => {
        console.log('UNCollection successful')
      }, () => {
        console.log('UNCollection failed')
      })
    },
    validate () {
      console.log('VALIDATE...')
      this.validateHair({
        'context': this,
        'hairid': this.hair.internalid
      }).then(() => {
        console.log('Validation successful')
      }, () => {
        console.log('Validation failed')
      })
    },
    unvalidate () {
      console.log('UNVALIDATE...')
      this.unvalidateHair({
        'context': this,
        'hairid': this.hair.internalid
      }).then(() => {
        console.log('UNValidation successful')
      }, () => {
        console.log('UNValidation failed')
      })
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.hair.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoriteHair({
          'context': this,
          'hairid': this.hair.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoriteHair({
          'context': this,
          'hairid': this.hair.internalid
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
