<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_hand"></i> {{ internalid ? 'Edit' : 'Add' }} a hand</h3>
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
                  <div class="form-group" :class="errorposture?'has-error':''">
                    <label>Posture</label>
                    <input type="text" class="form-control" placeholder="Posture" v-model="posture">
                    <span class="help-block" v-if="errorposture">The posture is mandatory</span>
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
                  <div class="form-group" :class="errorskincolor?'has-error':''">
                    <label>Skin color</label>
                    <input type="text" class="form-control" placeholder="Skin color" v-model="skincolor">
                    <span class="help-block" v-if="errorskincolor">The skincolor is mandatory</span>
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
  name: 'FormHand',
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
      errorbox: false,
      errorskincolor: false,
      errorposture: false,
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
    },
    internalid () {
      return this.$route.name === 'Edit hand' ? this.$route.params.id : null
    }
  },
  methods: {
    ...Vuex.mapActions(['createHand', 'updateHand']),
    retrieveHandParams () {
      if (this.internalid) {
        console.log('Hand Edition mode')
        let hand = this.hands.find(hand => hand.internalid === this.$route.params.id)
        this.boxselected = hand.boxid ? hand.boxid : 'box'
        this.nendoroidselected = hand.nendoroidid ? hand.nendoroidid : 'nendoroid'
        this.posture = hand.posture
        this.leftright = hand.leftright
        this.skincolor = hand.skin_color
        this.description = hand.description
      } else {
        console.log('Hand Addition mode')
      }
    },
    cancel () {
      this.boxselected = 'box'
      this.nendoroidselected = 'nendoroid'
      this.posture = null
      this.leftright = 'Left'
      this.skincolor = null
      this.description = null
      this.errorbox = false
      this.errorskincolor = false
      this.errorposture = false
      this.errordescription = false
      this.failure = false
      this.retrieveHandParams()
    },
    checkForm () {
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        this.errorbox = true
      } else {
        this.errorbox = false
      }
      if (this.skincolor === null) {
        this.errorskincolor = true
      } else {
        this.errorskincolor = false
      }
      if (this.posture === null) {
        this.errorposture = true
      } else {
        this.errorposture = false
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
      if (this.errorbox || this.errorskincolor || this.errorposture || this.errordescription) {
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
        body.posture = this.posture
        formData.append('posture', this.posture)
        body.leftright = this.leftright
        formData.append('leftright', this.leftright)
        body.skin_color = this.skincolor
        formData.append('skin_color', this.skincolor)
        body.description = this.description
        formData.append('description', this.description)
        if (this.internalid) {
          this.updateHand({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/hand/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createHand({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            router.push('/hand/' + response)
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
