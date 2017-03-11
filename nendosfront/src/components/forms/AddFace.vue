<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_face"></i> Add a face</h3>
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
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label>Eyes</label>
                    <input type="text" class="form-control" placeholder="Eyes" v-model="eyes">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Eyes color name</label>
                    <input type="text" class="form-control" placeholder="Eyes color name" v-model="eyescolor">
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label>Mouth</label>
                    <input type="text" class="form-control" placeholder="Mouth" v-model="mouth">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Skin color name</label>
                    <input type="text" class="form-control" placeholder="Skin color name" v-model="skincolor">
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
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Add face</button>
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
  name: 'AddFace',
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
    ...Vuex.mapActions(['createFace']),
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.eyes = null
      this.eyescolor = null
      this.mouth = null
      this.skincolor = null
      this.sex = 'Undefined'
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
        formData.append('boxid', this.boxselected === 'box' ? null : this.boxselected)
        formData.append('nendoroidid', this.nendoroidselected === 'nendoroid' ? null : this.nendoroidselected)
        formData.append('eyes', this.eyes)
        formData.append('eyes_color', this.eyescolor)
        formData.append('mouth', this.mouth)
        formData.append('skin_color', this.skincolor)
        formData.append('sex', this.sex)
        this.createFace({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/face/' + response)
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
