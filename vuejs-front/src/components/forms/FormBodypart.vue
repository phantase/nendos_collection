<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_body"></i> {{ internalid ? 'Edit' : 'Add' }} a bodypart</h3>
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
                      <option value="box" v-if="!frompart">- Box -</option>
                      <option v-for="box in boxes4select" :value="box.internalid" :key="box.internalid">
                        {{ box.category }} {{ box.number?'#'+box.number:'' }} - {{ box.name }}
                      </option>
                    </select>
                    <span class="help-block" v-if="errorbox">You must select a box</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Nendoroid</label>
                    <select class="form-control" v-model="nendoroidselected">
                      <option value="nendoroid" v-if="frompart !== 'nendoroid'">- Nendoroid -</option>
                      <option v-for="nendoroid in nendoroids4select" :value="nendoroid.internalid" :key="nendoroid.internalid">
                        {{ nendoroid.name }} {{ nendoroid.version?'-'+nendoroid.version:'' }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group" :class="errorpart?'has-error':''">
                    <label>Part</label>
                    <select2 placeholder="Part" :options="bodypartsPartCodeList" v-model="part"></select2>
                    <span class="help-block" v-if="errorpart">The part is mandatory</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group" :class="errormaincolor?'has-error':''">
                    <label>Main color</label>
                    <select2 placeholder="Main color" :options="bodypartsMainColorCodeList" v-model="maincolor"></select2>
                    <span class="help-block" v-if="errormaincolor">The main color is mandatory</span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label>Other color</label>
                    <select2 placeholder="Other color" :options="bodypartsOtherColorCodeList" v-model="othercolor"></select2>
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
                <span class="pull-right">
                  <button type="submit" class="btn btn-info" @click.prevent="submittoimage" v-if="!internalid">Save bodypart and upload image</button>
                  <button type="submit" class="btn btn-info" @click.prevent="submit">Save bodypart</button>
                </span>
              </div>
            </form>
          </div>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a bodypart. Please ask for them if you want to contribute to the database.
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="nav-tabs-custom" v-if="canedit">
          <ul class="nav nav-tabs pull-right">
            <li id="li_fromselected"><a href="#tab_fromselected" data-toggle="tab" aria-expanded="false">From selected part</a></li>
            <li id="li_fromall" class="active"><a href="#tab_fromall" data-toggle="tab" aria-expanded="false">From all parts</a></li>
            <li class="pull-left header"><i class="fa fa-map-signs"></i> Suggestions</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab_fromselected">
              <i>Click on the selected line to automatically fill the fields with these values.</i>
              <div class="row">
                <div class="col-md-6">
                  <div class="box box-solid no-shadow">
                    <div class="box-header">
                      <h4 class="box-title">Colors</h4>
                      <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                          <li v-if="pageColorsSelected > 0"><a @click="changePageColorsSelected(pageColorsSelected - 5)">«</a></li>
                          <li v-else><a class="disabled">«</a></li>
                          <li v-if="pageColorsSelected < (colorsSuggestionsSelected.length - 5)"><a @click="changePageColorsSelected(pageColorsSelected + 5)">»</a></li>
                          <li v-else><a class="disabled">»</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-body">
                      <ul class="todo-list">
                        <li v-for="(colorsSuggestion, index) in colorsSuggestionsSelected.slice(pageColorsSelected, pageColorsSelected + 5)" :key="index" @click="writeColors(colorsSuggestion)">
                          <span class="text">{{ colorsSuggestion[0] }} - {{ colorsSuggestion[1] }}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box box-solid no-shadow">
                    <div class="box-header">
                      <h4 class="box-title">Descriptions</h4>
                      <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                          <li v-if="pageDescriptionsSelected > 0"><a @click="changePageDescriptionsSelected(pageDescriptionsSelected - 5)">«</a></li>
                          <li v-else><a class="disabled">«</a></li>
                          <li v-if="pageDescriptionsSelected < (descriptionSuggestionsSelected.length - 5)"><a @click="changePageDescriptionsSelected(pageDescriptionsSelected + 5)">»</a></li>
                          <li v-else><a class="disabled">»</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-body">
                      <ul class="todo-list">
                        <li v-for="(descriptionSuggestion, index) in descriptionSuggestionsSelected.slice(pageDescriptionsSelected, pageDescriptionsSelected + 5)" :key="index" @click="writeDescription(descriptionSuggestion)">
                          <span class="text">{{ descriptionSuggestion }} </span>
                        </li>
                      </ul>
                    </div>
                    <div class="box-footer">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-binoculars"></i></span>
                          <input type="text" placeholder="filter" class="form-control" v-model="filterDescriptionsSelected" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane active" id="tab_fromall">
              <i>Click on the selected line to automatically fill the fields with these values.</i>
              <div class="row">
                <div class="col-md-6">
                  <div class="box box-solid no-shadow">
                    <div class="box-header">
                      <h4 class="box-title">Colors</h4>
                      <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                          <li v-if="pageColorsAll > 0"><a @click="changePageColorsAll(pageColorsAll - 5)">«</a></li>
                          <li v-else><a class="disabled">«</a></li>
                          <li v-if="pageColorsAll < (colorsSuggestionsAll.length - 5)"><a @click="changePageColorsAll(pageColorsAll + 5)">»</a></li>
                          <li v-else><a class="disabled">»</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-body">
                      <ul class="todo-list">
                        <li v-for="(colorsSuggestion, index) in colorsSuggestionsAll.slice(pageColorsAll, pageColorsAll + 5)" :key="index" @click="writeColors(colorsSuggestion)">
                          <span class="text">{{ colorsSuggestion[0] }} - {{ colorsSuggestion[1] }}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box box-solid no-shadow">
                    <div class="box-header">
                      <h4 class="box-title">Descriptions</h4>
                      <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                          <li v-if="pageDescriptionsAll > 0"><a @click="changePageDescriptionsAll(pageDescriptionsAll - 5)">«</a></li>
                          <li v-else><a class="disabled">«</a></li>
                          <li v-if="pageDescriptionsAll < (descriptionSuggestionsAll.length - 5)"><a @click="changePageDescriptionsAll(pageDescriptionsAll + 5)">»</a></li>
                          <li v-else><a class="disabled">»</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="box-body">
                      <ul class="todo-list">
                        <li v-for="(descriptionSuggestion, index) in descriptionSuggestionsAll.slice(pageDescriptionsAll, pageDescriptionsAll + 5)" :key="index" @click="writeDescription(descriptionSuggestion)">
                          <span class="text">{{ descriptionSuggestion }} </span>
                        </li>
                      </ul>
                    </div>
                    <div class="box-footer">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-binoculars"></i></span>
                          <input type="text" placeholder="filter" class="form-control" v-model="filterDescriptionsAll" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  name: 'FormBodypart',
  components: {
    Select2
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
      failure: false,
      noeditableelement: false,
      pageColorsAll: 0,
      pageDescriptionsAll: 0,
      filterDescriptionsAll: '',
      pageColorsSelected: 0,
      pageDescriptionsSelected: 0,
      filterDescriptionsSelected: '',
      willsubmittoimage: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'bodyparts', 'canedit',
      'bodypartsPartCodeList', 'bodypartsMainColorCodeList', 'bodypartsOtherColorCodeList']),
    boxes4select () {
      if (this.$route.params.frompart === 'box') {
        return this.boxes.filter(box => box.internalid === this.$route.params.fromid)
      } else if (this.$route.params.frompart === 'nendoroid') {
        return this.boxes.filter(box => box.internalid === this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.fromid).boxid)
      } else if (this.nendoroidselected !== 'nendoroid') {
        return this.boxes.filter(box => box.internalid === this.nendoroids.find(nendoroid => nendoroid.internalid === this.nendoroidselected).boxid)
      }
      return this.boxes
    },
    nendoroids4select () {
      if (this.$route.params.frompart === 'nendoroid') {
        return this.nendoroids.filter(nendoroid => nendoroid.internalid === this.$route.params.fromid)
      } else if (this.boxselected !== 'box') {
        return this.nendoroids.filter(nendoroid => nendoroid.boxid === this.boxselected)
      }
      return this.nendoroids
    },
    internalid () {
      return this.$route.name === 'Edit bodypart' ? this.$route.params.id : null
    },
    frompart () {
      return this.$route.params.frompart
    },
    descriptionSuggestionsSelected () {
      if (this.part) {
        return this.bodyparts
          .filter(a => a.part === this.part)
          .filter(a => a.description.toLowerCase().indexOf(this.filterDescriptionsSelected.toLowerCase()) > -1)
          .sort(this.dateSort)
          .map(b => b.description)
          .filter((elem, pos, arr) => elem && arr.indexOf(elem) === pos)
      }
      return []
    },
    colorsSuggestionsSelected () {
      if (this.part) {
        return this.bodyparts
          .filter(a => a.part === this.part)
          .sort(this.dateSort)
          .map(b => [b.main_color, b.other_color])
          .filter((elem, pos, arr) => elem && arr.map(b => b[0] + b[1]).indexOf(elem[0] + elem[1]) === pos)
      }
      return []
    },
    descriptionSuggestionsAll () {
      return this.bodyparts
        .concat()
        .filter(a => a.description.toLowerCase().indexOf(this.filterDescriptionsAll.toLowerCase()) > -1)
        .sort(this.dateSort)
        .map(b => b.description)
        .filter((elem, pos, arr) => elem && arr.indexOf(elem) === pos)
    },
    colorsSuggestionsAll () {
      return this.bodyparts
        .concat()
        .sort(this.dateSort)
        .map(b => [b.main_color, b.other_color])
        .filter((elem, pos, arr) => elem && arr.map(b => b[0] + b[1]).indexOf(elem[0] + elem[1]) === pos)
    }
  },
  watch: {
    internalid () {
      this.cancel()
    },
    part () {
      this.changePart()
      $('')
    }
  },
  methods: {
    ...Vuex.mapActions(['createBodypart', 'updateBodypart']),
    retrieveBodypartParams () {
      if (this.internalid) {
        console.log('Bodypart Edition mode')
        let bodypart = this.bodyparts.find(bodypart => bodypart.internalid === this.$route.params.id)
        if (bodypart) {
          this.boxselected = bodypart.boxid ? bodypart.boxid : 'box'
          this.nendoroidselected = bodypart.nendoroidid ? bodypart.nendoroidid : 'nendoroid'
          this.part = bodypart.part
          this.maincolor = bodypart.main_color
          this.othercolor = bodypart.other_color
          this.description = bodypart.description
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
      } else {
        console.log('Bodypart Addition mode')
      }
    },
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
      this.retrieveBodypartParams()
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
    submittoimage () {
      this.willsubmittoimage = true
      this.submit()
    },
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errorbox || this.errorpart || this.errormaincolor || this.errordescription) {
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
        body.part = this.part
        formData.append('part', this.part)
        body.main_color = this.maincolor
        formData.append('main_color', this.maincolor)
        if (this.othercolor) {
          body.other_color = this.othercolor
          formData.append('other_color', this.othercolor)
        }
        body.description = this.description
        formData.append('description', this.description)
        if (this.internalid) {
          this.updateBodypart({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/bodypart/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createBodypart({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            if (this.willsubmittoimage) {
              router.push('/bodypart/' + response + '/edit/image')
            } else {
              router.push('/bodypart/' + response)
            }
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
        }
      }
    },
    dateSort (d1, d2) {
      if (d1.editiondate > d2.editiondate) {
        return -1
      } else if (d1.editiondate < d2.editiondate) {
        return 1
      }
      return 0
    },
    writeDescription (description) {
      this.description = description
    },
    writeColors (colors) {
      this.maincolor = colors[0]
      this.othercolor = colors[1]
    },
    changePageColorsAll (newPageColorsAll) {
      this.pageColorsAll = newPageColorsAll
    },
    changePageDescriptionsAll (newPageDescriptionsAll) {
      this.pageDescriptionsAll = newPageDescriptionsAll
    },
    changePageColorsSelected (newPageColorsSelected) {
      this.pageColorsSelected = newPageColorsSelected
    },
    changePageDescriptionsSelected (newPageDescriptionsSelected) {
      this.pageDescriptionsSelected = newPageDescriptionsSelected
    },
    changePart () {
      $('#li_fromselected').addClass('active')
      $('#tab_fromselected').addClass('active')
      $('#li_fromall').removeClass('active')
      $('#tab_fromall').removeClass('active')
    }
  },
  mounted () {
    this.cancel()
    // $('select').select2()
    if (this.frompart === 'box') {
      this.boxselected = this.$route.params.fromid
    }
    if (this.frompart === 'nendoroid') {
      this.boxselected = this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.fromid).boxid
      this.nendoroidselected = this.$route.params.fromid
    }
  },
  beforeUpdate () {
    // $('select').select2()
  }
}
</script>

<style scoped>
  .todo-list > li:hover {
    background-color: lightyellow;
    cursor: pointer;
  }
  .pagination a {
    cursor: pointer;
  }
  .pagination .disabled {
    cursor: not-allowed;
    opacity: .65;
  }
</style>
