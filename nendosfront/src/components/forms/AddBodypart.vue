<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_body"></i> Add a bodypart</h3>
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
                <div class="col-md-12">
                  <div class="form-group" :class="errorpart?'has-error':''">
                    <label>Part</label>
                    <input type="text" class="form-control" placeholder="Part" v-model="part">
                    <span class="help-block" v-if="errorpart">The part is mandatory</span>
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
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Add bodypart</button>
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
  name: 'AddBodypart',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxselected: 'box',
      nendoroidselected: 'nendoroid',
      part: null,
      maincolor: null,
      othercolor: null,
      description: null,
      errorbox: false,
      errorpart: false,
      errormaincolor: false,
      errordescription: false,
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
    }
  },
  methods: {
    ...Vuex.mapActions(['createBodypart']),
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.part = null
      this.maincolor = null
      this.othercolor = null
      this.description = null
      this.errorbox = false
      this.errorpart = false
      this.errormaincolor = false
      this.errordescription = false
      this.failure = false
    },
    checkForm () {
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        this.errorbox = true
      } else {
        this.errorbox = false
      }
      if (this.part === null) {
        this.errorpart = true
      } else {
        this.errorpart = false
      }
      if (this.maincolor === null) {
        this.errormaincolor = true
      } else {
        this.errormaincolor = false
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
      if (this.errorbox || this.errorpart || this.errormaincolor || this.errordescription) {
        console.log('Cannot submit')
      } else {
        if (this.nendoroidselected !== 'nendoroid') {
          this.boxselected = this.nendoroids.filter(nendoroid => nendoroid.internalid === this.nendoroidselected)[0].boxid
        }
        console.log('Can submit')
        let formData = new FormData()
        formData.append('boxid', this.boxselected)
        if (this.nendoroidselected !== 'nendoroid') {
          formData.append('nendoroidid', this.nendoroidselected)
        }
        formData.append('part', this.part)
        formData.append('main_color', this.maincolor)
        if (this.othercolor) {
          formData.append('other_color', this.othercolor)
        }
        formData.append('description', this.description)
        this.createBodypart({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/bodypart/' + response)
        }, response => {
          console.log('Addition failed')
          this.failure = true
        })
      }
    }
  },
  mounted () {
    // $('select').select2()
  },
  beforeUpdate () {
    // $('select').select2()
  }
}
</script>

<style scoped>
</style>
