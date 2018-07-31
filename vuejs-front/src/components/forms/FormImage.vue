<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div>{{ this.$route.name }} # {{ imageNumber }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="hugefailure">
      <div class="col-md-12">
        <div class="box-body">
          <div class="alert alert-danger">
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            Huge failure, the file you have sent has not been saved on the server, please try again, if it doesn't work again, maybe our main server is dead (or you trying to do something you're not allowed to...).
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="canEditImage">
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Upload a new photo" collapsable="true" icon="fa-upload"></app-box-header>
          <div class="box-body">
            <div id="upload_zone">
              <span>Drop your picture here, <br/> or click the area to <br/><em>Browse your disk</em>...</span>
            </div>
            <div id="photo_infos">
              <h3>File info:</h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>File name</b>
                  <a class="pull-right">{{ file_name }}</a><br>
                </li>
                <li class="list-group-item">
                  <b>Size</b>
                  <a class="pull-right">{{ file_size }}</a><br>
                </li>
                <li class="list-group-item">
                  <b>Width</b>
                  <a class="pull-right">{{ file_width }}</a><br>
                </li>
                <li class="list-group-item">
                  <b>Height</b>
                  <a class="pull-right">{{ file_height }}</a><br>
                </li>
                <li class="list-group-item">
                  <b>Type</b>
                  <a class="pull-right">{{ file_type }}</a><br>
                </li>
              </ul>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" class="btn btn-app pull-right" :class="uploadable?'':'disabled'" @click="uploadPicture"><i class="fa fa-upload"></i>Upload it</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Canditate photo" collapsable="true" icon="fa-file-image-o"></app-box-header>
          <div class="box-body" v-if="failure">
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              The file you try to upload is not an image, please upload only images.
            </div>
          </div>
          <div class="box-body db-image" id="upload_image" v-if="!failure">
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Current photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.img_url+'/images/'+element+'/'+internalid+'/'+imageNumber+'/thumb'" v-if="(elementObject.nbpictures * 1) >= imageNumber" />
            <img :src="resources.img_url+'/images/unknown'" v-else />
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-else>
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or change an image. Please ask for them if you want to contribute to the database.
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

export default {
  name: 'FormImage',
  components: {
    AppBoxHeader
  },
  store: store,
  data () {
    return {
      resources: Resources,
      failure: false,
      hugefailure: false,
      uploadable: false,
      file_name: 'no file uploaded',
      file_size: 'n.a.',
      file_type: 'n.a.',
      file_width: 'n.a.',
      file_height: 'n.a.',
      file: null,
      noeditableelement: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands', 'users', 'user', 'canedit']),
    internalid () {
      return this.$route.params.id
    },
    imageNumber () {
      return this.$route.params.number
    },
    element () {
      return this.$route.path.split('/')[1]
    },
    elementObject () {
      switch (this.element) {
        case 'box':
          return this.boxes.find(box => box.internalid === this.$route.params.id)
        case 'nendoroid':
          return this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.id)
        case 'accessory':
          return this.accessories.find(accessory => accessory.internalid === this.$route.params.id)
        case 'bodypart':
          return this.bodyparts.find(bodypart => bodypart.internalid === this.$route.params.id)
        case 'face':
          return this.faces.find(face => face.internalid === this.$route.params.id)
        case 'hair':
          return this.hairs.find(hair => hair.internalid === this.$route.params.id)
        case 'hand':
          return this.hands.find(hand => hand.internalid === this.$route.params.id)
        case 'user':
          return this.users.find(user => user.internalid === this.$route.params.id)
        default:
          return null
      }
    },
    canEditImage () {
      if (this.element === 'user' && this.internalid === this.user.internalid) {
        return true
      } else {
        return this.canedit
      }
    }
  },
  methods: {
    ...Vuex.mapActions(['addBoxPicture', 'addNendoroidPicture', 'addAccessoryPicture', 'addBodypartPicture', 'addFacePicture', 'addHairPicture', 'addHandPicture', 'addUserPicture']),
    uploadPicture () {
      if (this.uploadable) {
        console.log('Try to upload picture')
        this.hugefailure = false
        if (this.file) {
          let formData = new FormData()
          formData.append('pic', this.file.nativeFile, this.file.name)
          let pathArray = this.$route.path.split('/')
          this.$http.post('auth/images/' + pathArray[1] + '/' + pathArray[2] + '/' + pathArray[5], formData).then(response => {
            switch (this.element) {
              case 'box':
                this.addBoxPicture({'internalid': this.$route.params.id, 'number': this.$route.params.number})
                break
              case 'nendoroid':
                this.addNendoroidPicture({'internalid': this.$route.params.id})
                break
              case 'accessory':
                this.addAccessoryPicture({'internalid': this.$route.params.id})
                break
              case 'bodypart':
                this.addBodypartPicture({'internalid': this.$route.params.id})
                break
              case 'face':
                this.addFacePicture({'internalid': this.$route.params.id})
                break
              case 'hair':
                this.addHairPicture({'internalid': this.$route.params.id})
                break
              case 'hand':
                this.addHandPicture({'internalid': this.$route.params.id})
                break
              case 'user':
                this.addUserPicture({'internalid': this.$route.params.id})
                break
            }
            router.push('/' + pathArray[1] + '/' + pathArray[2])
          }, response => {
            console.log(response)
            this.hugefailure = true
          })
        }
      }
    }
  },
  mounted () {
    if (this.canEditImage) {
      /* global FileDrop:true */
      var dropZone = new FileDrop('upload_zone')
      dropZone.event('send', files => {
        files.images().each(file => {
          if (file.type === 'image/jpeg') {
            this.failure = false

            this.file_name = file.name

            let fsize = file.size
            let tsize = ''
            if (fsize > 1024 * 1024) {
              tsize = Math.round(10 * (fsize / (1024 * 1024))) / 10 + ' MB'
            } else if (fsize > 1024) {
              tsize = Math.round((fsize / 1024)) + ' kB'
            }
            this.file_size = tsize

            this.file_type = file.type

            file.readDataURI(uri => {
              let img = new Image()
              img.onload = evt => {
                this.file_width = img.width + ' px'
                this.file_height = img.height + ' px'
                $('#upload_image').html('')
                $('#upload_image').append(img)
                this.uploadable = true
              }
              img.src = uri
            })

            this.file = file
          } else {
            $('#upload_image').html('')
            this.file = null
            this.failure = true
            this.uploadable = false
          }
        })
      })
    }
  },
  beforeUpdate () {
  }
}
</script>

<style scoped>
#upload_zone {
  border: dashed 2px #F57921;
  padding: 5px;
  text-align: center;
}

#upload_zone > span {
  font-size: 1.5em;
}
</style>
