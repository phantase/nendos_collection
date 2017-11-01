<template>
  <div class="db-box" v-if="photo">

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

    <div class="row" v-if="failure">
      <div class="col-md-12">
        <div class="box">
          <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <app-box-header title="Part to add" icon="fa-folder-open-o"></app-box-header>
          <div class="box-body">
            <div v-if="!selectedbox">
              <div class="form-group">
                <label for="chooseabox">(1) Choose a box</label>
                <input type="text" class="form-control" id="chooseabox" placeholder="Enter the name of the box/nendoroid" v-model="boxinput">
              </div>
              <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-6" v-for="box in correspondingboxes" @click="choosebox(box.internalid)" :key="box.internalid">
                  <box-tile :box="box" minimal="true"></box-tile>
                </div>
              </div>
            </div>
            <div v-else>
              <b>(1) Choose a box<button class="btn btn-xs bg-red pull-right" @click="unchoosebox">Reset box selection</button></b>
              <div>
                <span class="db-box-category text-yellow">
                  <span>{{ selectedbox.category}}</span>
                  <span v-if="selectedbox.number">#{{ selectedbox.number}}</span>
                </span>
                <span class="db-box-name">{{ selectedbox.name }}</span>
                <span class="db-box-series">{{ selectedbox.series ? selectedbox.series : '&nbsp;' }}</span>
              </div>
              <b>(2) Choose a part type</b>
              <div style="clear:both;">&nbsp;</div>
              <div class="btn-group">
                <button class="btn btn-app" :class="selectedparttype==='box'?'bg-orange':''" @click="chooseparttype('box')"><i class="fa icon-icon_nendo_boxes"></i>Box</button>
                <button class="btn btn-app" :class="selectedparttype==='nendoroid'?'bg-orange':''" @click="chooseparttype('nendoroid')"><i class="fa icon-icon_nendo_nendo"></i>Nendoroid</button>
                <button class="btn btn-app" :class="selectedparttype==='face'?'bg-orange':''" @click="chooseparttype('face')"><i class="fa icon-icon_nendo_face"></i>Face</button>
                <button class="btn btn-app" :class="selectedparttype==='hair'?'bg-orange':''" @click="chooseparttype('hair')"><i class="fa icon-icon_nendo_hair"></i>Hair</button>
                <button class="btn btn-app" :class="selectedparttype==='hand'?'bg-orange':''" @click="chooseparttype('hand')"><i class="fa icon-icon_nendo_hand"></i>Hand</button>
                <button class="btn btn-app" :class="selectedparttype==='bodypart'?'bg-orange':''" @click="chooseparttype('bodypart')"><i class="fa icon-icon_nendo_body"></i>Bodypart</button>
                <button class="btn btn-app" :class="selectedparttype==='accessory'?'bg-orange':''" @click="chooseparttype('accessory')"><i class="fa icon-icon_nendo_accessories"></i>Accessory</button>
              </div>
              <div style="clear:both;">&nbsp;</div>
              <div v-if="selectedparttype">
                <b>(3) Choose a part</b>
                <div style="clear:both;">&nbsp;</div>
                <div v-if="selectedparttype==='box'" @click="choosepart(box)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="box in boxes4box" :key="box.internalid">
                  <box-tile :box="box" :class="(selectedpart && selectedpart.internalid === box.internalid) ? 'bg-orange' : ''"
                    minimal="true"></box-tile>
                </div>
                <div v-if="selectedparttype==='nendoroid'" @click="choosepart(nendoroid)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="nendoroid in nendoroids4box" :key="nendoroid.internalid">
                  <nendoroid-tile :nendoroid="nendoroid" :class="(selectedpart && selectedpart.internalid === nendoroid.internalid) ? 'bg-orange' : ''"
                    minimal="true"></nendoroid-tile>
                </div>
                <div v-if="selectedparttype==='face'" @click="choosepart(face)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces4box" :key="face.internalid">
                  <face-tile :face="face" :class="(selectedpart && selectedpart.internalid === face.internalid) ? 'bg-orange' : ''"
                    minimal="true"></face-tile>
                </div>
                <div v-if="selectedparttype==='hair'" @click="choosepart(hair)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="hair in hairs4box" :key="hair.internalid">
                  <hair-tile :hair="hair" :class="(selectedpart && selectedpart.internalid === hair.internalid) ? 'bg-orange' : ''"
                    minimal="true"></hair-tile>
                </div>
                <div v-if="selectedparttype==='hand'" @click="choosepart(hand)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands4box" :key="hand.internalid">
                  <hand-tile :hand="hand" :class="(selectedpart && selectedpart.internalid === hand.internalid) ? 'bg-orange' : ''"
                    minimal="true"></hand-tile>
                </div>
                <div v-if="selectedparttype==='bodypart'" @click="choosepart(bodypart)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="bodypart in bodyparts4box" :key="bodypart.internalid">
                  <bodypart-tile :bodypart="bodypart" :class="(selectedpart && selectedpart.internalid === bodypart.internalid) ? 'bg-orange' : ''"
                    minimal="true"></bodypart-tile>
                </div>
                <div v-if="selectedparttype==='accessory'" @click="choosepart(accessory)"
                  class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessories4box" :key="accessory.internalid">
                  <accessory-tile :accessory="accessory" :class="(selectedpart && selectedpart.internalid === accessory.internalid) ? 'bg-orange' : ''"
                    minimal="true"></accessory-tile>
                </div>
              </div>
              <div style="clear:both;">&nbsp;</div>
              <div v-if="selectedpart">
                <b>(4) Draw a rectangle to select the part on the image bellow (optional)</b>
                <div>
                  <i><p>First click on image start the rectangle, second click stop the rectangle, going outside the image cancel the rectangle...</p>
                  <p>Once the rectangle is drawn, click on it if you want to remove it...</p></i>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-default" @click="unchoosebox">Cancel</button>
            <button type="submit" class="btn btn-info pull-right" :class="selectedpart ? '' : 'disabled'" @click="submit">Add part</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button class="btn btn-xs bg-red pull-right" :class="(maxX === -1 && maxY === -1) ? 'disabled': ''" @click="removeDrawing">Reset part location</button>
              <i class="fa fa-photo"></i> Photo (draw part location)
            </h3>
          </div>
          <div class="box-body db-photo"
            :class="selectedpart?'drawmode':''">
            <div class="db-photo-annotation-container">
              <img id="db-photo" :src="resources.img_url+'/images/photos/'+photo.internalid+'/full'" :orig-width="photo.width" :orig-height="photo.height" @load="handleResize" />
              <div class="db-photo-annotation-box"
                :style="drawingStyle"><a></a></div>
              <div class="db-photo-annotation-event-handler"
                @click="handleAction('click', $event)" @mousemove="handleAction('mousemove', $event)" @mouseleave="handleAction('mouseleave', $event)"></div>
            </div>
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
import router from './../../router'
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

import AppBoxHeader from './../layouts/BoxHeader'
import BoxTile from './../dblayouts/BoxTile'
import NendoroidTile from './../dblayouts/NendoroidTile'
import FaceTile from './../dblayouts/FaceTile'
import HairTile from './../dblayouts/HairTile'
import HandTile from './../dblayouts/HandTile'
import BodypartTile from './../dblayouts/BodypartTile'
import AccessoryTile from './../dblayouts/AccessoryTile'

export default {
  name: 'FormPhotoPart',
  components: {
    AppBoxHeader,
    BoxTile,
    NendoroidTile,
    FaceTile,
    HairTile,
    HandTile,
    BodypartTile,
    AccessoryTile
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxinput: null,
      selectedbox: null,
      selectedparttype: null,
      selectedpart: null,
      minX: -1,
      minY: -1,
      maxX: -1,
      maxY: -1,
      tempX: -1,
      tempY: -1,
      imgWidth: null,
      imgHeight: null,
      failure: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['photos', 'accessories', 'bodyparts', 'boxes', 'faces', 'hairs', 'hands', 'nendoroids']),
    photo () {
      return this.photos.filter(photo => photo.internalid === this.$route.params.id)[0]
    },
    correspondingboxes () {
      if (this.boxinput && this.boxinput.length > 2) {
        return this.boxes.filter(box => box.name.toLowerCase().indexOf(this.boxinput.toLowerCase()) > -1)
      } else {
        return null
      }
    },
    boxes4box () {
      return this.boxes.filter(box => box.internalid === this.selectedbox.internalid)
    },
    nendoroids4box () {
      return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.selectedbox.internalid)
    },
    faces4box () {
      return this.faces.filter(face => face.boxid === this.selectedbox.internalid)
    },
    hairs4box () {
      return this.hairs.filter(hair => hair.boxid === this.selectedbox.internalid)
    },
    hands4box () {
      return this.hands.filter(hand => hand.boxid === this.selectedbox.internalid)
    },
    bodyparts4box () {
      return this.bodyparts.filter(bodypart => bodypart.boxid === this.selectedbox.internalid)
    },
    accessories4box () {
      return this.accessories.filter(accessory => accessory.boxid === this.selectedbox.internalid)
    },
    drawingStyle () {
      let left = Math.ceil(Math.min(this.minX, this.tempX) * this.imagePhotoWidthRatio)
      let top = Math.ceil(Math.min(this.minY, this.tempY) * this.imagePhotoHeightRatio)
      let width = Math.ceil(Math.abs(this.minX - this.tempX) * this.imagePhotoWidthRatio)
      let height = Math.ceil(Math.abs(this.minY - this.tempY) * this.imagePhotoHeightRatio)
      let visibility = (this.minX === -1 || this.tempX === -1 || this.tempY === -1 || this.tempY === -1) ? 'hidden' : 'visible'
      return 'left: ' + left + 'px; top: ' + top + 'px; width: ' + width + 'px; height: ' + height + 'px; visibility: ' + visibility + ';'
    },
    imagePhotoWidthRatio () {
      return this.imgWidth / this.photo.width
    },
    imagePhotoHeightRatio () {
      return this.imgHeight / this.photo.height
    }
  },
  mounted () {
    window.addEventListener('resize', this.handleResize)
    if (document.getElementById('db-photo')) {
      this.handleResize()
    }
  },
  updated () {
    if (document.getElementById('db-photo')) {
      this.handleResize()
    }
  },
  beforeDestroy () {
    window.removeEventListener('resize', this.handleResize)
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  },
  methods: {
    ...Vuex.mapActions(['createPhotoAccessory', 'createPhotoBodypart', 'createPhotoBox', 'createPhotoFace', 'createPhotoHair', 'createPhotoHand', 'createPhotoNendoroid']),
    handleResize (event) {
      this.imgWidth = $('#db-photo').width()
      this.imgHeight = $('#db-photo').height()
    },
    handleAction (action, event) {
      if (this.selectedpart) {
        if (action === 'click') {
          if (this.minX === -1 && this.minY === -1) {
            this.minX = Math.ceil(event.layerX / this.imagePhotoWidthRatio)
            this.minY = Math.ceil(event.layerY / this.imagePhotoHeightRatio)
          } else {
            this.maxX = Math.ceil(event.layerX / this.imagePhotoWidthRatio)
            this.maxY = Math.ceil(event.layerY / this.imagePhotoHeightRatio)
          }
        } else if (action === 'mousemove') {
          if (this.minX !== -1 && this.minY !== -1 && this.maxX === -1 && this.maxY === -1) {
            this.tempX = Math.ceil(event.layerX / this.imagePhotoWidthRatio)
            this.tempY = Math.ceil(event.layerY / this.imagePhotoHeightRatio)
          }
        } else if (action === 'mouseleave') {
          if (this.maxX === -1 && this.maxY === -1) {
            this.removeDrawing()
          }
        }
      }
    },
    removeDrawing () {
      this.minX = -1
      this.minY = -1
      this.maxX = -1
      this.maxY = -1
      this.tempX = -1
      this.tempY = -1
    },
    choosebox (boxid) {
      this.boxinput = null
      this.selectedbox = this.boxes.find(box => box.internalid === boxid)
    },
    unchoosebox () {
      this.boxinput = null
      this.selectedbox = null
      this.selectedparttype = null
      this.selectedpart = null
      this.removeDrawing()
    },
    chooseparttype (parttype) {
      this.selectedparttype = parttype
      this.selectedpart = null
    },
    choosepart (part) {
      this.selectedpart = part
    },
    submit () {
      console.log('Submit form...')
      let body = {}
      let formData = new FormData()
      body.photoid = this.photo.internalid
      formData.append('photoid', this.photo.internalid)
      body.elementid = this.selectedpart.internalid
      formData.append('elementid', this.selectedpart.internalid)
      body.xmin = this.minX
      formData.append('xmin', this.minX)
      body.ymin = this.minY
      formData.append('ymin', this.minY)
      body.xmax = this.maxX
      formData.append('xmax', this.maxX)
      body.ymax = this.maxY
      formData.append('ymax', this.maxY)

      switch (this.selectedparttype) {
        case 'accessory':
          this.createPhotoAccessory({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'bodypart':
          this.createPhotoBodypart({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'box':
          this.createPhotoBox({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'face':
          this.createPhotoFace({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'hair':
          this.createPhotoHair({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'hand':
          this.createPhotoHand({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
        case 'nendoroid':
          this.createPhotoNendoroid({
            'context': this,
            'formData': formData,
            'photoid': this.photo.internalid
          }).then(response => {
            console.log('Addition successful')
            router.push('/photo/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
          break
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
    text-align: left;
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
  .db-box-category {
    font-weight: bold;
    font-size: 2em;
  }
  .db-box-series {
    font-style: italic;
  }
  .db-photo {
    text-align: center;
  }
  .db-photo img{
    max-width: 100%;
    max-height: 100%;
    box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7);
  }
  .striked {
    text-decoration: line-through;
  }
  .drawmode {
    cursor: crosshair;
  }
  .db-photo-annotation-box {
    position: absolute;
    border: dashed 1px black;
  }
  .db-photo-annotation-box > a {
    border: dashed 1px white;
    width: 100%;
    height: 100%;
    display: block;
  }
  .db-photo-annotation-event-handler {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
  }
</style>
