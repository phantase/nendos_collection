<template>
  <div class="db-box" v-if="accessory.internalid">

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

    <div class="row" v-if="accessory.colladdeddate">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            You own this accessory in {{ accessory.collquantity }} cop{{ accessory.collquantity > 1 ? 'ies' : 'y' }}
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
      <div class="col-md-12 col-sm-12 col-xs-12" v-if="photos.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Photos" collapsable="true" collapsed="true" icon="fa-photo"></app-box-header>
          <div class="box-body">
            <photos-tiles :photos="photos"></photos-tiles>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'
import AppBoxHeader from './layouts/BoxHeader'
import PhotosTiles from './dblayouts/PhotosTiles'

export default {
  name: 'Accessory',
  components: {
    AppBoxHeader,
    PhotosTiles
  },
  data () {
    return {
      resources: Resources,
      box: [],
      nendoroid: [],
      accessory: [],
      photos: []
    }
  },
  mounted () {
    this.$accessories = this.$resource('accessories{/id}')
    this.$nendoroids = this.$resource('accessories{/id}/nendoroids')
    this.$boxes = this.$resource('accessories{/id}/boxes')
    this.$photos = this.$resource('accessories{/id}/photos')

    this.$boxes.query({id: this.$route.params.id}).then((response) => {
      this.box = response.data[0]
    }, (response) => {
      console.log('Error', response)
    })
    this.$nendoroids.query({id: this.$route.params.id}).then((response) => {
      this.nendoroid = response.data[0]
    }, (response) => {
      console.log('Error', response)
    })
    this.$accessories.query({id: this.$route.params.id}).then((response) => {
      this.accessory = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$photos.query({id: this.$route.params.id}).then((response) => {
      this.photos = response.data
    }, (response) => {
      console.log('Error', response)
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
</style>
