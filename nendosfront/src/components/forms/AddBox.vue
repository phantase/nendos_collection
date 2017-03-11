<template>
  <div class="db-box">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_box"></i> Add a box</h3>
          </div>
          <div class="box-body">
            <form role="form">
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" v-model="name">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Series</label>
                    <input type="text" class="form-control" placeholder="Series" v-model="series">
                  </div>
                </div>
                <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" placeholder="Category" v-model="category">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Number</label>
                    <input type="text" class="form-control" placeholder="Number" v-model="number">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Manufacturer</label>
                    <input type="text" class="form-control" placeholder="Manufacturer" v-model="manufacturer">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Sculptor</label>
                    <input type="text" class="form-control" placeholder="Sculptor" v-model="sculptor">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Cooperation</label>
                    <input type="text" class="form-control" placeholder="Cooperation" v-model="cooperation">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Release date</label>
                    <input type="text" class="form-control" placeholder="YYYY/MM" v-model="releasedate">
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Price (¥)</label>
                    <input type="text" class="form-control" placeholder="Price (¥)" v-model="price">
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Specifications</label>
                    <input type="text" class="form-control" placeholder="Specifications" v-model="specifications">
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Official page URL</label>
                    <input type="text" class="form-control" placeholder="http://www.goodsmile.info/en/product/......" v-model="officialurl">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" @click.prevent="cancel">Cancel</button>
                <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Add box</button>
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
  name: 'AddBox',
  components: {
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
      officialurl: null
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'accessories', 'bodyparts', 'faces', 'hairs', 'hands'])
  },
  methods: {
    ...Vuex.mapActions(['createBox']),
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
    },
    submit () {
      console.log('Submit form')
      if (this.boxselected === 'box' && this.nendoroidselected === 'nendoroid') {
        console.log('Cannot submit')
        this.boxerror = true
      } else {
        console.log('Can submit')
        let formData = new FormData()
        formData.append('number', this.number)
        formData.append('name', this.name)
        formData.append('series', this.series)
        formData.append('manufacturer', this.manufacturer)
        formData.append('category', this.category)
        formData.append('price', this.price)
        formData.append('releasedate', this.releasedate.split('/')[0] + '-' + this.releasedate.split('/')[1] + '-01')
        formData.append('specifications', this.specifications)
        formData.append('sculptor', this.sculptor)
        formData.append('cooperation', this.cooperation)
        formData.append('officialurl', this.officialurl)
        this.createBox({
          'context': this,
          'formData': formData
        }).then(response => {
          console.log('Addition successful')
          router.push('/box/' + response)
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
