<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_boxes"></i> {{ internalid ? 'Edit' : 'Add' }} a box</h3>
          </div>
          <div class="box-body" v-if="canedit">
            <div class="alert alert-danger" v-if="failure">
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
            </div>
            <form role="form">
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errorname?'has-error':''">
                    <label>Name</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Name" v-model="name">
                    <span class="help-block" v-if="errorname">The name is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Series</label>
                    <select2 placeholder="Series" :options="boxesSeriesCodeList" v-model="series"></select2>
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errorcategory?'has-error':''">
                    <label>Category</label>
                    <select2 placeholder="Category" :options="boxesCategoryCodeList" v-model="category"></select2>
                    <span class="help-block" v-if="errorcategory">The category is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Number</label>
                    <input type="text" class="form-control" maxlength="5" placeholder="Number" v-model="number">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Manufacturer</label>
                    <select2 placeholder="Manufacturer" :options="boxesManufacturerCodeList" v-model="manufacturer"></select2>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Sculptor</label>
                    <select2 placeholder="Sculptor" :options="boxesSculptorCodeList" v-model="sculptor"></select2>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Cooperation</label>
                    <select2 placeholder="Cooperation" :options="boxesCooperationCodeList" v-model="cooperation"></select2>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorreleasedate?'has-error':''">
                    <label>Release date</label>
                    <input type="text" class="form-control" placeholder="YYYY/MM" v-model="releasedate">
                    <span class="help-block" v-if="errorreleasedate">The release date must be in format YYYY/MM</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorprice?'has-error':''">
                    <label>Price (¥)</label>
                    <input type="text" class="form-control" maxlength="10" placeholder="Price (¥)" v-model="price">
                    <span class="help-block" v-if="errorprice">The price must be a number</span>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Specifications</label>
                    <input type="text" class="form-control" maxlength="200" placeholder="Specifications" v-model="specifications">
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Official page URL</label>
                    <input type="text" class="form-control" maxlength="200" placeholder="http://www.goodsmile.info/en/product/......" v-model="officialurl">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Save box</button>
              </div>
            </form>
          </div>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a box. Please ask for them if you want to contribute to the database.
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
  name: 'FormBox',
  components: {
    Select2
  },
  store: store,
  data () {
    return {
      resources: Resources,
      number: null,
      name: null,
      series: null,
      manufacturer: null,
      category: null,
      price: null,
      releasedate: null,
      specifications: null,
      sculptor: null,
      cooperation: null,
      officialurl: null,
      errorname: false,
      errorcategory: false,
      errorprice: false,
      errorreleasedate: false,
      failure: false,
      noeditableelement: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'canedit',
      'boxesSeriesCodeList', 'boxesCategoryCodeList', 'boxesManufacturerCodeList', 'boxesSculptorCodeList', 'boxesCooperationCodeList']),
    internalid () {
      return this.$route.name === 'Edit box' ? this.$route.params.id : null
    }
  },
  watch: {
    internalid () {
      this.cancel()
    }
  },
  methods: {
    ...Vuex.mapActions(['createBox', 'updateBox']),
    retrieveBoxParams () {
      if (this.internalid) {
        console.log('Box Edition mode')
        let box = this.boxes.find(box => box.internalid === this.internalid)
        if (box) {
          this.name = box.name
          this.series = box.series
          this.category = box.category
          this.number = box.number
          this.manufacturer = box.manufacturer
          this.sculptor = box.sculptor
          this.cooperation = box.cooperation
          if (box.releasedate) {
            this.releasedate = box.releasedate.split('-')[0] + '/' + box.releasedate.split('-')[1]
          }
          this.price = box.price
          this.specifications = box.specifications
          this.officialurl = box.officialurl
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
      } else {
        console.log('Box Addition mode')
      }
    },
    cancel () {
      this.number = null
      this.name = null
      this.series = null
      this.manufacturer = null
      this.category = null
      this.price = null
      this.releasedate = null
      this.specifications = null
      this.sculptor = null
      this.cooperation = null
      this.officialurl = null
      this.errorname = false
      this.errorcategory = false
      this.errorprice = false
      this.errorreleasedate = false
      this.failure = false
      this.retrieveBoxParams()
    },
    checkForm () {
      if (this.name === null || this.name === '') {
        this.errorname = true
      } else {
        this.errorname = false
      }
      if (this.category === null || this.category === '') {
        this.errorcategory = true
      } else {
        this.errorcategory = false
      }
      if (this.price && isNaN(this.price)) {
        this.errorprice = true
      } else {
        this.errorprice = false
      }
      if (this.releasedate && !this.releasedate.match(/(19|20)[0-9]{2}\/[0-9]{2}/)) {
        this.errorreleasedate = true
      } else {
        this.errorreleasedate = false
      }
    },
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errorname || this.errorcategory || this.errorprice || this.errorreleasedate) {
        console.log('Cannot submit')
      } else {
        console.log('Can submit')
        let body = {}
        let formData = new FormData()
        if (this.internalid) {
          body.internalid = this.internalid
          formData.append('internalid', this.internalid)
        }
        if (this.number) {
          body.number = this.number
          formData.append('number', this.number)
        }
        body.name = this.name
        formData.append('name', this.name)
        if (this.series) {
          body.series = this.series
          formData.append('series', this.series)
        }
        if (this.manufacturer) {
          body.manufacturer = this.manufacturer
          formData.append('manufacturer', this.manufacturer)
        }
        body.category = this.category
        formData.append('category', this.category)
        if (this.price) {
          body.price = this.price
          formData.append('price', this.price)
        }
        if (this.releasedate) {
          body.releasedate = this.releasedate ? this.releasedate.split('/')[0] + '-' + this.releasedate.split('/')[1] + '-01' : null
          formData.append('releasedate', this.releasedate ? this.releasedate.split('/')[0] + '-' + this.releasedate.split('/')[1] + '-01' : null)
        }
        if (this.specifications) {
          body.specifications = this.specifications
          formData.append('specifications', this.specifications)
        }
        if (this.sculptor) {
          body.sculptor = this.sculptor
          formData.append('sculptor', this.sculptor)
        }
        if (this.cooperation) {
          body.cooperation = this.cooperation
          formData.append('cooperation', this.cooperation)
        }
        if (this.officialurl) {
          body.officialurl = this.officialurl
          formData.append('officialurl', this.officialurl)
        }
        if (this.internalid) {
          this.updateBox({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/box/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createBox({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            router.push('/box/' + response)
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
