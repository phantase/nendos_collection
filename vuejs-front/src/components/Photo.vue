<template>
  <div class="db-box" v-if="photo">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <button type="button" class="btn btn-xs pull-right" :class="photo.inuserfavorites==='1'?'text-red':'text-muted'"
                      data-toggle="tooltip"
                      :title="favoriteTooltipTitle"
                      :disabled="!authenticated"
                      @click="doFavorite">
                <i class="fa fa-heart" ></i>
                <span class="badge bg-yellow">{{ photo.numberfavorited ? photo.numberfavorited : '0' }}</span>
              </button>
              <router-link :to="'/photo/'+photo.internalid+'/addpart'" class="btn btn-xs bg-orange pull-right margin-right"><i class="fa fa-binoculars" v-if="authenticated"></i> Identify a part</router-link>
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
          <div class="box-body db-photo">
            <div class="db-photo-annotation-container">
              <img id="db-photo" :src="resources.img_url+'/images/photos/'+photo.internalid+'/full'" :orig-width="photo.width" :orig-height="photo.height" @load="handleResize" />
              <div :id="'db-photo-box-annotation-'+box.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-box-category text-yellow'>`+box.category+(box.number ? ' #'+box.number:'')+`</div>
                              <div class='db-box-name'>`+box.name+`</div>
                              <div class='db-box-series'>`+box.series+`</div>`"
                    v-for="box in boxes4photo" :key="box.internalid"><a><i class="icon-icon_nendo_boxes bg-orange"></i></a></div>
              <div :id="'db-photo-nendoroid-annotation-'+nendoroid.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-nendoroid-name'>`+nendoroid.name+`</div>
                              <div class='db-nendoroid-version'>`+(nendoroid.version ? nendoroid.version : '')+`</div>`"
                    v-for="nendoroid in nendoroids4photo" :key="nendoroid.internalid"><a><i class="icon-icon_nendo_nendo bg-orange"></i></a></div>
              <div :id="'db-photo-hair-annotation-'+hair.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-hair-frontback text-yellow'>`+hair.frontback+`</div>
                              <div class='db-hair-haircut'><span class='text-yellow'>Haircut:</span> `+hair.haircut+`</div>
                              <div class='db-hair-description'><span class='text-yellow'>Description:</span> `+hair.description+`</div>`"
                    v-for="hair in hairs4photo" :key="hair.internalid"><a><i class="icon-icon_nendo_hair bg-orange"></i></a></div>
              <div :id="'db-photo-accessory-annotation-'+accessory.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-accessory-type text-yellow'>`+accessory.type+`</div>
                              <div class='db-accessory-description'><span class='text-yellow'>Description:</span> `+accessory.description+`</div>`"
                    v-for="accessory in accessories4photo" :key="accessory.internalid"><a><i class="icon-icon_nendo_accessories bg-orange"></i></a></div>
              <div :id="'db-photo-bodypart-annotation-'+bodypart.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-bodypart-part text-yellow'>`+bodypart.part+`</div>
                              <div class='db-bodypart-description'><span class='text-yellow'>Description:</span> `+bodypart.description+`</div>`"
                    v-for="bodypart in bodyparts4photo" :key="bodypart.internalid"><a><i class="icon-icon_nendo_body bg-orange"></i></a></div>
              <div :id="'db-photo-face-annotation-'+face.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-face-eyes'><span class='text-yellow'>Eyes:</span> `+face.eyes+`</div>
                              <div class='db-face-mouth'><span class='text-yellow'>Mouth:</span> `+face.mouth+`</div>`"
                    v-for="face in faces4photo" :key="face.internalid"><a><i class="icon-icon_nendo_face bg-orange"></i></a></div>
              <div :id="'db-photo-hand-annotation-'+hand.photoannotationid" class="db-photo-annotation"
                    data-toggle="tooltip" data-html="true"
                    :title="`<div class='db-hand-leftright text-yellow'>`+hand.leftright+`</div>
                              <div class='db-hand-posture'><span class='text-yellow'>Posture:</span> `+hand.posture+`</div>`"
                    v-for="hand in hands4photo" :key="hand.internalid"><a><i class="icon-icon_nendo_hand bg-orange"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header :title="'Tags ('+(photo.tags?photo.tags.length:0)+')'" collapsable="true" collapsed="true" icon="fa-tags"></app-box-header>
          <div class="box-body">
            <span class="label label-primary margin-right" v-for="tag in photo.tags" :key="tag.internalid"><i class="fa fa-tag"></i> {{ tag.tag }}</span>
            <span v-if="!photo.tags"><i class="fa fa-ban text-red"></i> No tags</span>
            <a class="btn btn-xs" v-if="authenticated" @click="addTag=!addTag"><i class="fa fa-plus"></i> Add a tag</a>
            <transition name="fade">
              <div v-if="addTag">
                <hr>
                <div class="row">
                  <div class="col-md-8">
                    <select2 placeholder="New tag" :options="photosTagsCodeList" v-model="newTag"></select2>
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
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="boxes4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Boxes ('+boxes4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_boxes"></app-box-header>
          <div class="box-body">
            <boxes-tiles :boxes="boxes4photo" tilessize="big"></boxes-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="nendoroids4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Nendoroids ('+nendoroids4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_nendo"></app-box-header>
          <div class="box-body">
            <nendoroids-tiles :nendoroids="nendoroids4photo" tilessize="big"></nendoroids-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="faces4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Faces ('+faces4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_face"></app-box-header>
          <div class="box-body">
            <faces-tiles :faces="faces4photo" tilessize="big"></faces-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hairs4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hairs ('+hairs4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hair"></app-box-header>
          <div class="box-body">
            <hairs-tiles :hairs="hairs4photo" tilessize="big"></hairs-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="hands4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Hands ('+hands4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_hand"></app-box-header>
          <div class="box-body">
            <hands-tiles :hands="hands4photo" tilessize="big"></hands-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="bodyparts4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Bodyparts ('+bodyparts4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_body"></app-box-header>
          <div class="box-body">
            <bodyparts-tiles :bodyparts="bodyparts4photo" tilessize="big"></bodyparts-tiles>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12" v-if="accessories4photo.length > 0">
        <div class="box collapsed-box">
          <app-box-header :title="'Accessories ('+accessories4photo.length+')'" collapsable="true" collapsed="true" icon="icon-icon_nendo_accessories"></app-box-header>
          <div class="box-body">
            <accessories-tiles :accessories="accessories4photo" tilessize="big"></accessories-tiles>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <favorited-tile :favusers="photo.favusers"></favorited-tile>
    </div>

    <history-box elementtype="photo" :internalid="photo.internalid"></history-box>

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
import BoxesTiles from './dblayouts/BoxesTiles'
import NendoroidsTiles from './dblayouts/NendoroidsTiles'
import FacesTiles from './dblayouts/FacesTiles'
import HairsTiles from './dblayouts/HairsTiles'
import HandsTiles from './dblayouts/HandsTiles'
import BodypartsTiles from './dblayouts/BodypartsTiles'
import AccessoriesTiles from './dblayouts/AccessoriesTiles'
import FavoritedTile from './dblayouts/FavoritedTile'
import HistoryBox from './dblayouts/HistoryBox'
import Select2 from './atomic/Select2'

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
    AccessoriesTiles,
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
    ...Vuex.mapGetters(['photos',
      'accessories', 'photoaccessories',
      'bodyparts', 'photobodyparts',
      'boxes', 'photoboxes',
      'faces', 'photofaces',
      'hairs', 'photohairs',
      'hands', 'photohands',
      'nendoroids', 'photonendoroids',
      'authenticated', 'photosTagsCodeList']),
    photo () {
      return this.photos.filter(photo => photo.internalid === this.$route.params.id)[0]
    },
    accessories4photo () {
      let e4p = []
      this.photoaccessories.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.accessories.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    bodyparts4photo () {
      let e4p = []
      this.photobodyparts.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.bodyparts.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    boxes4photo () {
      let e4p = []
      this.photoboxes.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.boxes.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    faces4photo () {
      let e4p = []
      this.photofaces.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.faces.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    hairs4photo () {
      let e4p = []
      this.photohairs.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.hairs.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    hands4photo () {
      let e4p = []
      this.photohands.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.hands.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    nendoroids4photo () {
      let e4p = []
      this.photonendoroids.filter(pe => pe.photoid === this.$route.params.id).forEach((element) => {
        e4p.push(Object.assign({}, element, this.nendoroids.filter(e => e.internalid === element.elementid)[0], element))
      })
      return e4p
    },
    favoriteTooltipTitle () {
      if (this.authenticated) {
        return this.photo.inuserfavorites ? 'In your favorites (remove)' : 'Not in your favorites (add)'
      } else {
        return 'Number of times favorited'
      }
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
    ...Vuex.mapActions(['favoritePhoto', 'unfavoritePhoto', 'tagPhoto']),
    handleResize (event) {
      try {
        let ratio = document.getElementById('db-photo').offsetWidth / this.photo.width
        for (let i = this.accessories4photo.length - 1; i >= 0; i--) {
          let accessory = this.accessories4photo[i]
          document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.left = Math.floor(accessory.xmin * ratio) + 'px'
          document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.top = Math.floor(accessory.ymin * ratio) + 'px'
          document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.width = Math.floor((accessory.xmax - accessory.xmin) * ratio) + 'px'
          document.getElementById('db-photo-accessory-annotation-' + accessory.photoannotationid).style.height = Math.floor((accessory.ymax - accessory.ymin) * ratio) + 'px'
        }
        for (let i = this.bodyparts4photo.length - 1; i >= 0; i--) {
          let bodypart = this.bodyparts4photo[i]
          document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.left = Math.floor(bodypart.xmin * ratio) + 'px'
          document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.top = Math.floor(bodypart.ymin * ratio) + 'px'
          document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.width = Math.floor((bodypart.xmax - bodypart.xmin) * ratio) + 'px'
          document.getElementById('db-photo-bodypart-annotation-' + bodypart.photoannotationid).style.height = Math.floor((bodypart.ymax - bodypart.ymin) * ratio) + 'px'
        }
        for (let i = this.faces4photo.length - 1; i >= 0; i--) {
          let face = this.faces4photo[i]
          document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.left = Math.floor(face.xmin * ratio) + 'px'
          document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.top = Math.floor(face.ymin * ratio) + 'px'
          document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.width = Math.floor((face.xmax - face.xmin) * ratio) + 'px'
          document.getElementById('db-photo-face-annotation-' + face.photoannotationid).style.height = Math.floor((face.ymax - face.ymin) * ratio) + 'px'
        }
        for (let i = this.hairs4photo.length - 1; i >= 0; i--) {
          let hair = this.hairs4photo[i]
          document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.left = Math.floor(hair.xmin * ratio) + 'px'
          document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.top = Math.floor(hair.ymin * ratio) + 'px'
          document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.width = Math.floor((hair.xmax - hair.xmin) * ratio) + 'px'
          document.getElementById('db-photo-hair-annotation-' + hair.photoannotationid).style.height = Math.floor((hair.ymax - hair.ymin) * ratio) + 'px'
        }
        for (let i = this.hands4photo.length - 1; i >= 0; i--) {
          let hand = this.hands4photo[i]
          document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.left = Math.floor(hand.xmin * ratio) + 'px'
          document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.top = Math.floor(hand.ymin * ratio) + 'px'
          document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.width = Math.floor((hand.xmax - hand.xmin) * ratio) + 'px'
          document.getElementById('db-photo-hand-annotation-' + hand.photoannotationid).style.height = Math.floor((hand.ymax - hand.ymin) * ratio) + 'px'
        }
        for (let i = this.nendoroids4photo.length - 1; i >= 0; i--) {
          let nendoroid = this.nendoroids4photo[i]
          document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.left = Math.floor(nendoroid.xmin * ratio) + 'px'
          document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.top = Math.floor(nendoroid.ymin * ratio) + 'px'
          document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.width = Math.floor((nendoroid.xmax - nendoroid.xmin) * ratio) + 'px'
          document.getElementById('db-photo-nendoroid-annotation-' + nendoroid.photoannotationid).style.height = Math.floor((nendoroid.ymax - nendoroid.ymin) * ratio) + 'px'
        }
        for (let i = this.boxes4photo.length - 1; i >= 0; i--) {
          let box = this.boxes4photo[i]
          document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.left = Math.floor(box.xmin * ratio) + 'px'
          document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.top = Math.floor(box.ymin * ratio) + 'px'
          document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.width = Math.floor((box.xmax - box.xmin) * ratio) + 'px'
          document.getElementById('db-photo-box-annotation-' + box.photoannotationid).style.height = Math.floor((box.ymax - box.ymin) * ratio) + 'px'
        }
      } catch (exception) {
        // do nothing
      }
    },
    doFavorite () {
      console.log('DO FAVORITE...')
      if (this.photo.inuserfavorites === '1') {
        console.log('UNFAVORITE...')
        this.unfavoritePhoto({
          'context': this,
          'photoid': this.photo.internalid
        }).then(() => {
          console.log('UNFavorite successful')
          $('[data-toggle="tooltip"]').tooltip('fixTitle')
        }, () => {
          console.log('UnFavorite failed')
        })
      } else {
        console.log('FAVORITE...')
        this.favoritePhoto({
          'context': this,
          'photoid': this.photo.internalid
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
      this.tagPhoto({
        'context': this,
        'photoid': this.photo.internalid,
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
      if (vm.photo) {
        document.title += ' / ' + vm.photo.title + ' / Id: ' + vm.photo.internalid
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
  .margin-right {
    margin-right: 5px;
  }
</style>
