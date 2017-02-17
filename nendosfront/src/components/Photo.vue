<template>
  <div class="db-box" v-if="photo.internalid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-photo-title">{{ photo.title }}</div>
              <div class="db-photo-username">by {{ photo.username }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" icon="fa-photo"></app-box-header>
          <div class="box-body db-image db-photo-annotation-container">
            <img id="db-photo" :src="resources.imagesurl+'/images/nendos/photos/'+photo.internalid+'_full'" :orig-width="photo.width" :orig-height="photo.height" />
            <div :id="'db-photo-box-annotation-'+box.photoannotationid" class="db-photo-annotation" v-for="box in boxes"><a><i class="icon-icon_nendo_box bg-orange"></i></a></div>
            <div :id="'db-photo-nendoroid-annotation-'+nendoroid.photoannotationid" class="db-photo-annotation" v-for="nendoroid in nendoroids"><a><i class="icon-icon_nendo_nendo bg-orange"></i></a></div>
            <div :id="'db-photo-hair-annotation-'+hair.photoannotationid" class="db-photo-annotation" v-for="hair in hairs"><a><i class="icon-icon_nendo_hair bg-orange"></i></a></div>
            <div :id="'db-photo-accessory-annotation-'+accessory.photoannotationid" class="db-photo-annotation" v-for="accessory in accessories"><a><i class="icon-icon_nendo_accessories bg-orange"></i></a></div>
            <div :id="'db-photo-bodypart-annotation-'+bodypart.photoannotationid" class="db-photo-annotation" v-for="bodypart in bodyparts"><a><i class="icon-icon_nendo_body bg-orange"></i></a></div>
            <div :id="'db-photo-face-annotation-'+face.photoannotationid" class="db-photo-annotation" v-for="face in faces"><a><i class="icon-icon_nendo_face bg-orange"></i></a></div>
            <div :id="'db-photo-hand-annotation-'+hand.photoannotationid" class="db-photo-annotation" v-for="hand in hands"><a><i class="icon-icon_nendo_hand bg-orange"></i></a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="boxes.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Boxes" collapsable="true" collapsed="true" icon="icon-icon_nendo_box"></app-box-header>
          <div class="box-body">
            <boxes-tiles :boxes="boxes" tilessize="big"></boxes-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="nendoroids.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Nendoroids" collapsable="true" collapsed="true" icon="icon-icon_nendo_nendo"></app-box-header>
          <div class="box-body">
            <nendoroids-tiles :nendoroids="nendoroids" tilessize="big"></nendoroids-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Faces" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hairs" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Hands" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Bodyparts" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories.length > 0">
        <div class="box collapsed-box">
          <app-box-header title="Accessories" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'
import AppBoxHeader from './layouts/BoxHeader'
import BoxesTiles from './dblayouts/BoxesTiles'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'

export default {
  name: 'Photo',
  components: {
    AppBoxHeader,
    BoxesTiles,
    NendoroidsTiles,
    FacesTiles,
    HairsTiles,
    HandsTiles,
    BodypartsTiles,
    AccessoriesTiles
  },
  data () {
    return {
      resources: Resources,
      photo: [],
      boxes: [],
      nendoroids: [],
      faces: [],
      hairs: [],
      hands: [],
      bodyparts: [],
      accessories: []
    }
  },
  mounted () {
    this.$photos = this.$resource('photos{/id}')
    this.$boxes = this.$resource('photos{/id}/boxes')
    this.$nendoroids = this.$resource('photos{/id}/nendoroids')
    this.$faces = this.$resource('photos{/id}/faces')
    this.$hairs = this.$resource('photos{/id}/hairs')
    this.$hands = this.$resource('photos{/id}/hands')
    this.$bodyparts = this.$resource('photos{/id}/bodyparts')
    this.$accessories = this.$resource('photos{/id}/accessories')

    this.$photos.query({id: this.$route.params.id}).then((response) => {
      this.photo = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$boxes.query({id: this.$route.params.id}).then((response) => {
      this.boxes = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$nendoroids.query({id: this.$route.params.id}).then((response) => {
      this.nendoroids = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$faces.query({id: this.$route.params.id}).then((response) => {
      this.faces = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$hairs.query({id: this.$route.params.id}).then((response) => {
      this.hairs = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$hands.query({id: this.$route.params.id}).then((response) => {
      this.hands = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$bodyparts.query({id: this.$route.params.id}).then((response) => {
      this.bodyparts = response.data
    }, (response) => {
      console.log('Error', response)
    })
    this.$accessories.query({id: this.$route.params.id}).then((response) => {
      this.accessories = response.data
    }, (response) => {
      console.log('Error', response)
    })
    window.addEventListener('resize', this.handleResize)
  },
  updated () {
    this.handleResize()
  },
  beforeDestroy () {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    handleResize (event) {
      let ratio = document.getElementById('db-photo').offsetWidth / this.photo.width
      for (let i = this.accessories.length - 1; i >= 0; i--) {
        let accessory = this.accessories[i]
        document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.left = Math.floor(accessory.xmin * ratio) + 'px'
        document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.top = Math.floor(accessory.ymin * ratio) + 'px'
        document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.width = Math.floor((accessory.xmax - accessory.xmin) * ratio) + 'px'
        document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.height = Math.floor((accessory.ymax - accessory.ymin) * ratio) + 'px'
      }
      for (let i = this.bodyparts.length - 1; i >= 0; i--) {
        let bodypart = this.bodyparts[i]
        document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.left = Math.floor(bodypart.xmin * ratio) + 'px'
        document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.top = Math.floor(bodypart.ymin * ratio) + 'px'
        document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.width = Math.floor((bodypart.xmax - bodypart.xmin) * ratio) + 'px'
        document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.height = Math.floor((bodypart.ymax - bodypart.ymin) * ratio) + 'px'
      }
      for (let i = this.faces.length - 1; i >= 0; i--) {
        let face = this.faces[i]
        document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.left = Math.floor(face.xmin * ratio) + 'px'
        document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.top = Math.floor(face.ymin * ratio) + 'px'
        document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.width = Math.floor((face.xmax - face.xmin) * ratio) + 'px'
        document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.height = Math.floor((face.ymax - face.ymin) * ratio) + 'px'
      }
      for (let i = this.hairs.length - 1; i >= 0; i--) {
        let hair = this.hairs[i]
        document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.left = Math.floor(hair.xmin * ratio) + 'px'
        document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.top = Math.floor(hair.ymin * ratio) + 'px'
        document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.width = Math.floor((hair.xmax - hair.xmin) * ratio) + 'px'
        document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.height = Math.floor((hair.ymax - hair.ymin) * ratio) + 'px'
      }
      for (let i = this.hands.length - 1; i >= 0; i--) {
        let hand = this.hands[i]
        document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.left = Math.floor(hand.xmin * ratio) + 'px'
        document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.top = Math.floor(hand.ymin * ratio) + 'px'
        document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.width = Math.floor((hand.xmax - hand.xmin) * ratio) + 'px'
        document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.height = Math.floor((hand.ymax - hand.ymin) * ratio) + 'px'
      }
      for (let i = this.nendoroids.length - 1; i >= 0; i--) {
        let nendoroid = this.nendoroids[i]
        document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.left = Math.floor(nendoroid.xmin * ratio) + 'px'
        document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.top = Math.floor(nendoroid.ymin * ratio) + 'px'
        document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.width = Math.floor((nendoroid.xmax - nendoroid.xmin) * ratio) + 'px'
        document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.height = Math.floor((nendoroid.ymax - nendoroid.ymin) * ratio) + 'px'
      }
      for (let i = this.boxes.length - 1; i >= 0; i--) {
        let box = this.boxes[i]
        document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.left = Math.floor(box.xmin * ratio) + 'px'
        document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.top = Math.floor(box.ymin * ratio) + 'px'
        document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.width = Math.floor((box.xmax - box.xmin) * ratio) + 'px'
        document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.height = Math.floor((box.ymax - box.ymin) * ratio) + 'px'
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
  .db-photo-annotation-container {
    position: relative;
  }
  .db-photo-annotation {
    position: absolute;
    border: dashed 1px black;
    background-color: rgba(255,255,255,0.2);
    visibility: hidden;
  }
  .db-photo-annotation a {
      border: dashed 1px white;
      display: block;
      width: 100%;
      height: 100%;
  }
  .db-photo-annotation-container:hover .db-photo-annotation {
    visibility: visible;
  }
  .db-photo-annotation i {
    border-right: dashed 1px white;
    border-bottom: dashed 1px white;
    font-size: 2em;
    opacity: 0.7;
  }
  .db-photo-annotation:hover a {
    border: dashed 1px #ff851b;
  }
  .db-photo-annotation:hover i {
    opacity: 1;
  }
</style>
