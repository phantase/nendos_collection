<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_face"></i> {{ internalid ? 'Edit' : 'Add' }} a face</h3>
          </div>
          <form role="form" v-if="canedit">
            <div class="box-body">
              <div class="alert alert-danger" v-if="failure">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="errorbox?'has-error':''">
                    <label>Box</label>
                    <select class="form-control" v-model="boxselected">
                      <option value="box" v-if="!frompart">- Box -</option>
                      <option v-for="box in boxes4select" :value="box.internalid" :key="box.internalid">
                        {{ box.category }} {{ box.number?'#'+box.number:'' }} - {{ box.name }}
                      </option>
                    </select>
                    <span class="help-block" v-if="errorbox">You must select a box</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Nendoroid</label>
                    <select class="form-control" v-model="nendoroidselected">
                      <option value="nendoroid" v-if="frompart !== 'nendoroid'">- Nendoroid -</option>
                      <option v-for="nendoroid in nendoroids4select" :value="nendoroid.internalid" :key="nendoroid.internalid">
                        {{ nendoroid.name }} {{ nendoroid.version?'-'+nendoroid.version:'' }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="erroreyes?'has-error':''">
                    <label>Eyes</label>
                    <auto-suggest placeholder="Eyes" :options="facesEyesCodeList" v-model="eyes"></auto-suggest>
                    <span class="help-block" v-if="erroreyes">The eyes are mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="erroreyescolor?'has-error':''">
                    <label>Eyes color name</label>
                    <auto-suggest placeholder="Eyes color name" :options="facesEyesColorCodeList" v-model="eyescolor"></auto-suggest>
                    <span class="help-block" v-if="erroreyescolor">The eyes color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errormouth?'has-error':''">
                    <label>Mouth</label>
                    <auto-suggest placeholder="Mouth" :options="facesMouthCodeList" v-model="mouth"></auto-suggest>
                    <span class="help-block" v-if="errormouth">The mouth is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorskincolor?'has-error':''">
                    <label>Skin color name</label>
                    <auto-suggest placeholder="Skin color name" :options="facesSkinColorCodeList" v-model="skincolor"></auto-suggest>
                    <span class="help-block" v-if="errorskincolor">The skin color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Gender</label>
                    <auto-suggest placeholder="Gender" :options="facesSexCodeList" v-model="sex"></auto-suggest>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default" @click.prevent="cancel">Cancel</button>
              <span class="pull-right">
                <button type="submit" class="btn btn-info" @click.prevent="submittoimage" v-if="!internalid">Save face and upload image</button>
                <button type="submit" class="btn btn-info" @click.prevent="submit">Save face</button>
              </span>
            </div>
          </form>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a face. Please ask for them if you want to contribute to the database.
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

import AutoSuggest from './../atomic/AutoSuggest'

export default {
  name: 'FormFace',
  components: {
    AutoSuggest
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxselected: 'box',
      nendoroidselected: 'nendoroid',
      eyes: null,
      eyescolor: null,
      mouth: null,
      skincolor: null,
      sex: 'Undefined',
      errorbox: false,
      erroreyes: false,
      erroreyescolor: false,
      errormouth: false,
      errorskincolor: false,
      failure: false,
      noeditableelement: false,
      willsubmittoimage: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'faces', 'canedit',
      'facesEyesCodeList', 'facesEyesColorCodeList', 'facesMouthCodeList', 'facesSkinColorCodeList', 'facesSexCodeList']),
    boxes4select () {
      if (this.$route.params.frompart === 'box') {
        return this.boxes.filter(box => box.internalid === this.$route.params.fromid)
      } else if (this.$route.params.frompart === 'nendoroid') {
        return this.boxes.filter(box => box.internalid === this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.fromid).boxid)
      } else if (this.nendoroidselected !== 'nendoroid') {
        return this.boxes.filter(box => box.internalid === this.nendoroids.find(nendoroid => nendoroid.internalid === this.nendoroidselected).boxid)
      }
      return this.boxes
    },
    nendoroids4select () {
      if (this.$route.params.frompart === 'nendoroid') {
        return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.$route.params.fromid)
      } else if (this.boxselected !== 'box') {
        return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.boxselected)
      }
      return this.nendoroids
    },
    internalid () {
      return this.$route.name === 'Edit face' ? this.$route.params.id : null
    },
    frompart () {
      return this.$route.params.frompart
    }
  },
  watch: {
    internalid () {
      this.cancel()
    }
  },
  methods: {
    ...Vuex.mapActions(['createFace', 'updateFace']),
    retrieveFaceParams () {
      if (this.internalid) {
        console.log('Face Edition mode')
        let face = this.faces.find(face => face.internalid === this.$route.params.id)
        if (face) {
          this.boxselected = face.boxid ? face.boxid : 'box'
          this.nendoroidselected = face.nendoroidid ? face.nendoroidid : 'nendoroid'
          this.eyes = face.eyes
          this.eyescolor = face.eyes_color
          this.mouth = face.mouth
          this.skincolor = face.skin_color
          this.sex = face.sex
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
      } else {
        console.log('Face Addition mode')
      }
    },
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.eyes = null
      this.eyescolor = null
      this.mouth = null
      this.skincolor = null
      this.sex = 'Undefined'
      this.errorbox = false
      this.erroreyes = false
      this.erroreyescolor = false
      this.errormouth = false
      this.errorskincolor = false
      this.failure = false
      this.retrieveFaceParams()
    },
    checkForm () {
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        this.errorbox = true
      } else {
        this.errorbox = false
      }
      if (this.eyes === null) {
        this.erroreyes = true
      } else {
        this.erroreyes = false
      }
      if (this.eyescolor === null) {
        this.erroreyescolor = true
      } else {
        this.erroreyescolor = false
      }
      if (this.mouth === null) {
        this.errormouth = true
      } else {
        this.errormouth = false
      }
      if (this.skincolor === null) {
        this.errorskincolor = true
      } else {
        this.errorskincolor = false
      }
    },
    submittoimage () {
      this.willsubmittoimage = true
      this.submit()
    },
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errorbox || this.erroreyes || this.erroreyescolor || this.errormouth || this.errorskincolor) {
        console.log('Cannot submit')
      } else {
        if (this.nendoroidselected !== 'nendoroid') {
          this.boxselected = this.nendoroids.find(nendoroid => nendoroid.internalid === this.nendoroidselected).boxid
        }
        console.log('Can submit')
        let body = {}
        let formData = new FormData()
        if (this.internalid) {
          body.internalid = this.internalid
          formData.append('internalid', this.internalid)
        }
        body.boxid = this.boxselected
        formData.append('boxid', this.boxselected)
        if (this.nendoroidselected !== 'nendoroid') {
          body.nendoroidid = this.nendoroidselected
          formData.append('nendoroidid', this.nendoroidselected)
        }
        body.eyes = this.eyes
        formData.append('eyes', this.eyes)
        body.eyes_color = this.eyescolor
        formData.append('eyes_color', this.eyescolor)
        body.mouth = this.mouth
        formData.append('mouth', this.mouth)
        body.skin_color = this.skincolor
        formData.append('skin_color', this.skincolor)
        body.sex = this.sex
        formData.append('sex', this.sex)
        if (this.internalid) {
          this.updateFace({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/face/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createFace({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            if (this.willsubmittoimage) {
              router.push('/face/' + response + '/edit/image/1')
            } else {
              router.push('/face/' + response)
            }
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
        }
      }
    }
  },
  mounted () {
    this.cancel()
    if (this.frompart === 'box') {
      this.boxselected = this.$route.params.fromid
    }
    if (this.frompart === 'nendoroid') {
      this.boxselected = this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.fromid).boxid
      this.nendoroidselected = this.$route.params.fromid
    }
  }
}
</script>

<style scoped>
</style>
