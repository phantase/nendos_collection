<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_hair"></i> {{ internalid ? 'Edit' : 'Add' }} a hair</h3>
          </div>
          <div class="box-body" v-if="canedit">
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
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="errormaincolor?'has-error':''">
                    <label>Main color</label>
                    <input type="text" class="form-control" placeholder="Main color" v-model="maincolor">
                    <span class="help-block" v-if="errormaincolor">The main color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Other color</label>
                    <input type="text" class="form-control" placeholder="Other color" v-model="othercolor">
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errorhaircut?'has-error':''">
                    <label>Haircut</label>
                    <input type="text" class="form-control" placeholder="Haircut" v-model="haircut">
                    <span class="help-block" v-if="errorhaircut">The haircut is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Front/Back/Other</label>
                    <select class="form-control" v-model="frontback">
                      <option value="Front">Front</option>
                      <option value="Back">Back</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group" :class="errordescription?'has-error':''">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="Description" v-model="description">
                    <span class="help-block" v-if="errordescription">The description is mandatory</span>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Save bodypart</button>
              </div>
            </form>
          </div>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a hair. Please ask for them if you want to contribute to the database.
            </div>
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
  name: 'FormHair',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxselected: 'box',
      nendoroidselected: 'nendoroid',
      maincolor: null,
      othercolor: null,
      haircut: null,
      frontback: 'Front',
      description: null,
      errorbox: false,
      errormaincolor: false,
      errorhaircut: false,
      errordescription: false,
      failure: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands', 'canedit']),
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
      return this.$route.name === 'Edit hair' ? this.$route.params.id : null
    }
  },
  watch: {
    internalid () {
      this.cancel()
    }
  },
  methods: {
    ...Vuex.mapActions(['createHair', 'updateHair']),
    retrieveHairParams () {
      if (this.internalid) {
        console.log('Hair Edition mode')
        let hair = this.hairs.find(hair => hair.internalid === this.$route.params.id)
        this.boxselected = hair.boxid ? hair.boxid : 'box'
        this.nendoroidselected = hair.nendoroidid ? hair.nendoroidid : 'nendoroid'
        this.maincolor = hair.main_color
        this.othercolor = hair.other_color
        this.haircut = hair.haircut
        this.frontback = hair.frontback
        this.description = hair.description
      } else {
        console.log('Hair Addition mode')
      }
    },
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.maincolor = null
      this.othercolor = null
      this.haircut = null
      this.frontback = 'Front'
      this.description = null
      this.errorbox = false
      this.errormaincolor = false
      this.errorhaircut = false
      this.errordescription = false
      this.failure = false
      this.retrieveHairParams()
    },
    checkForm () {
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        this.errorbox = true
      } else {
        this.errorbox = false
      }
      if (this.maincolor === null) {
        this.errormaincolor = true
      } else {
        this.errormaincolor = false
      }
      if (this.haircut === null) {
        this.errorhaircut = true
      } else {
        this.errorhaircut = false
      }
      if (this.description === null) {
        this.errordescription = true
      } else {
        this.errordescription = false
      }
    },
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errorbox || this.errormaincolor || this.errorhaircut || this.errordescription) {
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
        body.main_color = this.maincolor
        formData.append('main_color', this.maincolor)
        if (this.othercolor) {
          body.other_color = this.othercolor
          formData.append('other_color', this.othercolor)
        }
        body.haircut = this.haircut
        formData.append('haircut', this.haircut)
        body.frontback = this.frontback
        formData.append('frontback', this.frontback)
        body.description = this.description
        formData.append('description', this.description)
        if (this.internalid) {
          this.updateHair({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/hair/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createHair({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            router.push('/hair/' + response)
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
