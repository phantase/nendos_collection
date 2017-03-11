<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_hair"></i> Add a hair</h3>
          </div>
          <div class="box-body">
            <form role="form">
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="boxerror?'has-error':''">
                    <label>Box</label>
                    <select class="form-control" v-model="boxselected">
                      <option value="box">- Box -</option>
                      <option v-for="box in boxes4select" :value="box.internalid">{{ box.category }} {{ box.number?'#'+box.number:'' }} - {{ box.name }}</option>
                    </select>
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
                  <div class="form-group">
                    <label>Main color</label>
                    <input type="text" class="form-control" placeholder="Main color" v-model="maincolor">
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Other color</label>
                    <input type="text" class="form-control" placeholder="Other color" v-model="othercolor">
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label>Haircut</label>
                    <input type="text" class="form-control" placeholder="Haircut" v-model="haircut">
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
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="Description" v-model="description">
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
  name: 'AddHair',
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
      boxerror: false
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
    ...Vuex.mapActions(['createHair']),
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.maincolor = null
      this.othercolor = null
      this.haircut = null
      this.frontback = 'Front'
      this.description = null
      this.boxerror = false
    },
    submit () {
      console.log('Submit form')
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        console.log('Cannot submit')
        this.boxerror = true
      } else {
        if (this.nendoroidselected !== 'nendoroid') {
          this.boxselected = this.nendoroids.filter(nendoroid => nendoroid.internalid === this.nendoroidselected)[0].boxid
        }
        console.log('Can submit')
        let formData = new FormData()
        formData.append('boxid', this.boxselected)
        formData.append('nendoroidid', this.nendoroidselected)
        formData.append('main_color', this.maincolor)
        formData.append('other_color', this.othercolor)
        formData.append('haircut', this.haircut)
        formData.append('frontback', this.frontback)
        formData.append('description', this.description)
        this.createHair({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/hair/' + response)
        }, response => {
          console.log('Addition failed')
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
