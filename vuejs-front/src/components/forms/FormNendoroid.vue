<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_nendo"></i> {{ internalid ? 'Edit' : 'Add' }} a nendoroid</h3>
          </div>
          <form role="form" v-if="canedit">
            <div class="box-body">
              <div class="alert alert-danger" v-if="failure">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group" :class="errorbox?'has-error':''">
                    <label>Box</label>
                    <select class="form-control" v-model="boxselected">
                      <option value="box" v-if="frompart !== 'box'">- Box -</option>
                      <option v-for="box in boxes4select" :value="box.internalid" :key="box.internalid">
                        {{ box.category }} {{ box.number?'#'+box.number:'' }} - {{ box.name }}
                      </option>
                    </select>
                    <span class="help-block" v-if="errorbox">You must select a box</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="errorname?'has-error':''">
                    <label>Name</label>
                    <select2 placeholder="Name" :options="nendoroidsNameCodeList" v-model="name"></select2>
                    <span class="help-block" v-if="errorname">The name is mandatory</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Version</label>
                    <select2 placeholder="Version" :options="nendoroidsVersionCodeList" v-model="version"></select2>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Gender</label>
                    <select2 placeholder="Gender" :options="nendoroidsSexCodeList" v-model="sex"></select2>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Dominant color <i>(deprecated)</i></label>
                    <input type="text" class="form-control" placeholder="Dominant color" v-model="dominantcolor" disabled="">
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default" @click.prevent="cancel">Cancel</button>
              <span class="pull-right">
                <button type="submit" class="btn btn-info" @click.prevent="submittoimage" v-if="!internalid">Save nendoroid and upload image</button>
                <button type="submit" class="btn btn-info" @click.prevent="submit">Save nendoroid</button>
              </span>
            </div>
        </form>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a nendoroid. Please ask for them if you want to contribute to the database.
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

import Select2 from './../atomic/Select2'

export default {
  name: 'FormNendoroid',
  components: {
    Select2
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxselected: 'box',
      name: null,
      version: null,
      sex: 'Female',
      dominantcolor: '000000',
      errorbox: false,
      errorname: false,
      failure: false,
      noeditableelement: false,
      willsubmittoimage: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'canedit',
      'nendoroidsNameCodeList', 'nendoroidsVersionCodeList', 'nendoroidsSexCodeList']),
    boxes4select () {
      return this.frompart === 'box' ? this.boxes.filter(box => box.internalid === this.$route.params.fromid) : this.boxes
    },
    internalid () {
      return this.$route.name === 'Edit nendoroid' ? this.$route.params.id : null
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
    ...Vuex.mapActions(['createNendoroid', 'updateNendoroid']),
    retrieveNendoroidParams () {
      if (this.internalid) {
        console.log('Nendoroid Edition mode')
        let nendoroid = this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.id)
        if (nendoroid) {
          this.boxselected = nendoroid.boxid
          this.name = nendoroid.name
          this.version = nendoroid.version
          this.sex = nendoroid.sex
          this.dominantcolor = nendoroid.dominant_color
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
      } else {
        console.log('Nendoroid Addition mode')
      }
    },
    cancel () {
      this.boxselected = 'box'
      this.name = null
      this.version = null
      this.sex = 'Female"'
      this.dominantcolor = '000000'
      this.errorbox = false
      this.errorname = false
      this.failure = false
      this.retrieveNendoroidParams()
    },
    checkForm () {
      if (this.boxselected === 'box') {
        this.errorbox = true
      } else {
        this.errorbox = false
      }
      if (this.name === null) {
        this.errorname = true
      } else {
        this.errorname = false
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
      if (this.errorbox || this.errorname) {
        console.log('Cannot submit')
      } else {
        console.log('Can submit')
        let body = {}
        let formData = new FormData()
        if (this.internalid) {
          body.internalid = this.internalid
          formData.append('internalid', this.internalid)
        }
        body.boxid = this.boxselected
        formData.append('boxid', this.boxselected)
        body.name = this.name
        formData.append('name', this.name)
        if (this.version) {
          body.version = this.version
          formData.append('version', this.version)
        }
        body.sex = this.sex
        formData.append('sex', this.sex)
        body.dominant_color = this.dominantcolor
        formData.append('dominant_color', this.dominantcolor)
        if (this.internalid) {
          this.updateNendoroid({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/nendoroid/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createNendoroid({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            if (this.willsubmittoimage) {
              router.push('/nendoroid/' + response + '/edit/image')
            } else {
              router.push('/nendoroid/' + response)
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
    // $('select').select2()
    if (this.frompart === 'box') {
      this.boxselected = this.$route.params.fromid
    }
  },
  beforeUpdate () {
    // $('select').select2()
  }
}
</script>

<style scoped>
</style>
