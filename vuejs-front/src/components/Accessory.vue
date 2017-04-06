<template>
  <div class="db-box" v-if="accessory">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <router-link :to="'/accessory/'+accessory.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canedit"><i class="fa fa-edit"></i> Edit</router-link>
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
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo" editable="true" :editlink="'/accessory/'+accessory.internalid+'/edit/image'"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.apiurl+'/images/accessories/'+accessory.internalid+'/thumb'" />
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

    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="History" collapsable="true" collapsed="true" icon="fa-history" @docollapse="loadhistory"></app-box-header>
          <div class="box-body">
            <div class="overlay" v-if="historyloading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <ul class="timeline" v-else>
              <template v-for="historyitem in history">
                <li class="time-label">
                    <span class="bg-orange">
                        {{ historyitem.actiondate.split(' ')[0] }}
                    </span>
                </li>
                <li>
                    <i class="fa fa-plus bg-blue" v-if="historyitem.action === 'Creation'"></i>
                    <i class="fa fa-pencil bg-maroon" v-if="historyitem.action === 'Update'"></i>
                    <i class="fa fa-check-square-o bg-green" v-if="historyitem.action === 'Validation'"></i>
                    <i class="fa fa-square-o bg-red" v-if="historyitem.action === 'Unvalidation'"></i>
                    <i class="fa fa-image bg-purple" v-if="historyitem.action === 'Addition'"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ historyitem.actiondate.split(' ')[1] }}</span>

                        <h3 class="timeline-header"><router-link :to="'/user/'+historyitem.userid">{{ historyitem.username }}</router-link> ({{ historyitem.action }})</h3>

                        <div class="timeline-body">
                            {{ historyitem.detail }}
                        </div>

                        <div class="timeline-footer">
                            <router-link :to="'/box/'+historyitem.boxid" class="btn btn-primary btn-xs" v-if="historyitem.boxid"><i class="fa icon-icon_nendo_boxes"></i> Box</router-link>
                            <router-link :to="'/nendoroid/'+historyitem.nendoroidid" class="btn btn-primary btn-xs" v-if="historyitem.nendoroidid"><i class="fa icon-icon_nendo_nendo"></i> Nendoroid</router-link>
                            <router-link :to="'/face/'+historyitem.faceid" class="btn btn-primary btn-xs" v-if="historyitem.faceid"><i class="fa icon-icon_nendo_face"></i> Face</router-link>
                            <router-link :to="'/hair/'+historyitem.hairid" class="btn btn-primary btn-xs" v-if="historyitem.hairid"><i class="fa icon-icon_nendo_hair"></i> Hair</router-link>
                            <router-link :to="'/hand/'+historyitem.handid" class="btn btn-primary btn-xs" v-if="historyitem.handid"><i class="fa icon-icon_nendo_hand"></i> Hand</router-link>
                            <router-link :to="'/bodypart/'+historyitem.bodypartid" class="btn btn-primary btn-xs" v-if="historyitem.bodypartid"><i class="fa icon-icon_nendo_body"></i> Bodypart</router-link>
                            <router-link :to="'/accessory/'+historyitem.accessoryid" class="btn btn-primary btn-xs" v-if="historyitem.accessoryid"><i class="fa icon-icon_nendo_accessories"></i> Accessory</router-link>
                            <router-link :to="'/photo/'+historyitem.photoid" class="btn btn-primary btn-xs" v-if="historyitem.photoid"><i class="fa fa-image"></i> Photo</router-link>
                        </div>
                    </div>
                </li>
              </template>
              <li>
                <i class="fa fa-clock-o bg-grey"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

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
      resources: Resources,
      history: null,
      historyloading: true
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'photos', 'photoaccessories', 'authenticated', 'viewvalidation', 'canedit']),
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
    }
  },
  methods: {
    ...Vuex.mapActions(['collectAccessory', 'uncollectAccessory', 'validateAccessory', 'unvalidateAccessory']),
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
    loadhistory () {
      console.log('Try to retrieve history...')
      this.$http.get('accessory/' + this.$route.params.id + '/history').then(response => {
        console.log('History loaded...')
        this.history = response.body
        this.historyloading = false
      }, response => {
        console.log('History not loaded...')
      })
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
