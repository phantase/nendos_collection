<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div>Add a photo</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="!authenticated">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              <div>You don't have the rights to add a photo. But you can create your own account to be able to manage your collection and add your photos, it's free. </div>
              <div><router-link to="/register" >Yes, bring me to registration!</router-link></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="authenticated">
      <div class="col-md-12">
        <div class="box">
          <app-box-header title="Photo Guidelines" collapsable="true" icon="fa-legal"></app-box-header>
          <div class="box-body">
            <p>Please remember that this website is not made for picture hosting (many other solutions exist over the Internet). The purpose of this picture uploading is to illustrate the use of the different Nendoroids and their respective parts/elements.</p>
            <p>You must be the author of the picture and release it under a <a href="http://creativecommons.org/licenses/by-nc-nd/3.0/us/" target="_blank">Create Commons By-NC-ND License</a>.</p>
            <p>We don't accept pictures that can be considered as NSFW, that includes (but is not exhaustive to):
              <ul>
                <li>Nudity;</li>
                <li>Strategically covered nudity;</li>
                <li>Sheer or see-through clothing;</li>
                <li>Lewd or provocative poses;</li>
                <li>Close-ups of breasts, buttlocks, or crotches.</li>
              </ul>
            </p>
            <p>We reserve the right to remove offending pictures from this website without notice and to banish users breaking these Gallery Guidelines. We will decide in our sole discretin if these pictures violate or not the Guidelines.</p>
          </div>
          <div class="box-footer">
            <div class="checkbox">
              <label>
                <input type="checkbox" v-model="guidelinesaccepted"> I've read, understood and accept the guidelines.
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="hugefailure">
      <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              Huge failure, the file you have sent has not been saved on the server, please try again, if it doesn't work again, maybe our main server is dead (or you're trying to do something you're not allowed to...).
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row" v-if="authenticated" v-show="guidelinesaccepted">
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
              <div class="form-group" :class="errortitle?'has-error':''">
                <label for="phototitle"><i class="fa fa-times-circle-o" v-if="errortitle"></i> Photo title</label>
                <input type="text" class="form-control" :disabled="uploadable?false:true" id="phototitle" placeholder="Title" v-model="phototitle">
                <span class="help-block" v-if="errortitle">Please provide a title</span>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="button" class="btn btn-app pull-right" :class="uploadable?'':'disabled'" @click="uploadPicture"><i class="fa fa-upload"></i>Upload it</button>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-12 col-xs-12">
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
  name: 'FormPhoto',
  components: {
    AppBoxHeader
  },
  store: store,
  data () {
    return {
      resources: Resources,
      guidelinesaccepted: false,
      failure: false,
      hugefailure: false,
      uploadable: false,
      file_name: 'no file uploaded',
      file_size: 'n.a.',
      file_type: 'n.a.',
      file_width: 'n.a.',
      file_height: 'n.a.',
      file: null,
      phototitle: null,
      errortitle: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands', 'authenticated']),
    internalid () {
      return this.$route.params.id
    },
    element () {
      return this.$route.path.split('/')[1]
    }
  },
  methods: {
    ...Vuex.mapActions(['createPhoto']),
    uploadPicture () {
      if (this.uploadable) {
        console.log('Try to upload photo')
        this.hugefailure = false
        if (this.phototitle) {
          this.errortitle = false
          if (this.file) {
            let formData = new FormData()
            formData.append('pic', this.file.nativeFile, this.file.name)
            formData.append('title', this.phototitle)
            this.createPhoto({
              'context': this,
              'formData': formData
            }).then(response => {
              console.log('Addition Successful')
              router.push('/photo/' + response)
            }, response => {
              console.log(response)
              this.hugefailure = true
            })
          }
        } else {
          this.errortitle = true
        }
      }
    }
  },
  mounted () {
    if (this.authenticated) {
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
