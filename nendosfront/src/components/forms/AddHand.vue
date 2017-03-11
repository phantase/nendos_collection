<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_hand"></i> Add a hand</h3>
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
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Posture</label>
                    <input type="text" class="form-control" placeholder="Posture" v-model="posture">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Left/Right/Both</label>
                    <select class="form-control" v-model="leftright">
                      <option value="Left">Left</option>
                      <option value="Right">Right</option>
                      <option value="Both">Both</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Skin color</label>
                    <input type="text" class="form-control" placeholder="Skin color" v-model="skincolor">
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
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Add hand</button>
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
  name: 'AddHand',
  components: {
  },
  store: store,
  data () {
    return {
      resources: Resources,
      boxselected: 'box',
      nendoroidselected: 'nendoroid',
      posture: null,
      leftright: 'Left',
      skincolor: null,
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
    ...Vuex.mapActions(['createHand']),
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.posture = null
      this.leftright = 'Left'
      this.skincolor = null
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
        formData.append('boxid', this.boxselected === 'box' ? null : this.boxselected)
        formData.append('nendoroidid', this.nendoroidselected === 'nendoroid' ? null : this.nendoroidselected)
        formData.append('posture', this.posture)
        formData.append('leftright', this.leftright)
        formData.append('skin_color', this.skincolor)
        formData.append('description', this.description)
        this.createHand({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/hand/' + response)
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
