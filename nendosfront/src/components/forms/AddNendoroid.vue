<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_nendo"></i> Add a nendoroid</h3>
          </div>
          <div class="box-body">
            <div class="alert alert-danger" v-if="failure">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
            </div>
            <form role="form">
              <div class="row">
                <div class="col-md-12 col-sm-12">
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
                  <div class="form-group" :class="errorname?'has-error':''">
                    <label>Name</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Name" v-model="name">
                    <span class="help-block" v-if="errorname">The name is mandatory</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Version</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Version" v-model="version">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Sex</label>
                    <select class="form-control" v-model="sex">
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Dominant color <i>(deprecated)</i></label>
                    <input type="text" class="form-control" placeholder="Dominant color" v-model="dominantcolor" disabled="">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Add nendoroid</button>
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
  name: 'AddNendoroid',
  components: {
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
      failure: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands']),
    boxes4select () {
      return this.boxes
    }
  },
  methods: {
    ...Vuex.mapActions(['createNendoroid']),
    cancel () {
      this.boxselected = 'box'
      this.name = null
      this.version = null
      this.sex = 'Female"'
      this.dominantcolor = '000000'
      this.errorbox = false
      this.errorname = false
      this.failure = false
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
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errorbox || this.errorname) {
        console.log('Cannot submit')
      } else {
        console.log('Can submit')
        let formData = new FormData()
        formData.append('boxid', this.boxselected)
        formData.append('name', this.name)
        if (this.version) {
          formData.append('version', this.version)
        }
        formData.append('sex', this.sex)
        formData.append('dominant_color', this.dominantcolor)
        this.createNendoroid({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/nendoroid/' + response)
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
