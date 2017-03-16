<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_face"></i> {{ internalid ? 'Edit' : 'Add' }} a face</h3>
          </div>
          <div class="box-body">
            <div class="alert alert-danger" v-if="failure">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
            </div>
            <form role="form">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="errorbox?'has-error':''">
                    <label>Box</label>
                    <select class="form-control" v-model="boxselected">
                      <option value="box">- Box -</option>
                      <option v-for="box in boxes4select" :value="box.internalid">{{ box.category }} {{ box.number?'#'+box.number:'' }} - {{ box.name }}</option>
                    </select>
                    <span class="help-block" v-if="errorbox">You must select a box</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Nendoroid</label>
                    <select class="form-control" v-model="nendoroidselected">
                      <option value="nendoroid">- Nendoroid -</option>
                      <option v-for="nendoroid in nendoroids4select" :value="nendoroid.internalid">{{ nendoroid.name }} {{ nendoroid.version?'-'+nendoroid.version:'' }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="erroreyes?'has-error':''">
                    <label>Eyes</label>
                    <input type="text" class="form-control" placeholder="Eyes" v-model="eyes">
                    <span class="help-block" v-if="erroreyes">The eyes are mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="erroreyescolor?'has-error':''">
                    <label>Eyes color name</label>
                    <input type="text" class="form-control" placeholder="Eyes color name" v-model="eyescolor">
                    <span class="help-block" v-if="erroreyescolor">The eyes color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errormouth?'has-error':''">
                    <label>Mouth</label>
                    <input type="text" class="form-control" placeholder="Mouth" v-model="mouth">
                    <span class="help-block" v-if="errormouth">The mouth is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorskincolor?'has-error':''">
                    <label>Skin color name</label>
                    <input type="text" class="form-control" placeholder="Skin color name" v-model="skincolor">
                    <span class="help-block" v-if="errorskincolor">The skin color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Sex</label>
                    <select class="form-control" v-model="sex">
                      <option value="Undefined">- Sex -</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Save face</button>
              </div>
            </form>
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

export default {
  name: 'FormFace',
  components: {
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
      failure: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands']),
    boxes4select () {
      if (this.nendoroidselected !== 'nendoroid') {
        return this.boxes.filter(box => box.internalid === this.nendoroids.filter(nendoroid => nendoroid.internalid === this.nendoroidselected)[0].boxid)
      }
      return this.boxes
    },
    nendoroids4select () {
      if (this.boxselected !== 'box') {
        return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.boxselected)
      }
      return this.nendoroids
    },
    internalid () {
      return this.$route.name === 'Edit face' ? this.$route.params.id : null
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
        this.boxselected = face.boxid ? face.boxid : 'box'
        this.nendoroidselected = face.nendoroidid ? face.nendoroidid : 'nendoroid'
        this.eyes = face.eyes
        this.eyescolor = face.eyes_color
        this.mouth = face.mouth
        this.skincolor = face.skin_color
        this.sex = face.sex
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
            router.push('/face/' + response)
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
    // $('select').select2()
  },
  beforeUpdate () {
    // $('select').select2()
  }
}
</script>

<style scoped>
</style>
