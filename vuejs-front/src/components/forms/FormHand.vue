<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa icon-icon_nendo_hand"></i> {{ internalid ? 'Edit' : 'Add' }} a hand</h3>
          </div>
          <form role="form" v-if="canedit">
            <div class="box-body">
              <div class="alert alert-danger" v-if="failure">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                An error has occurred! Please check the values you have entered and check again. If the problem persists, try later. And it the problem still persists, please contact an administrator.
              </div>
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
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorposture?'has-error':''">
                    <label>Posture</label>
                    <auto-suggest placeholder="Posture" :options="handsPostureCodeList" v-model="posture"></auto-suggest>
                    <span class="help-block" v-if="errorposture">The posture is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                    <label>Left/Right/Both</label>
                    <auto-suggest placeholder="Left/Right/Both" :options="handsLeftRightCodeList" v-model="leftright"></auto-suggest>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errorskincolor?'has-error':''">
                    <label>Skin color</label>
                    <auto-suggest placeholder="Skin color" :options="handsSkinColorCodeList" v-model="skincolor"></auto-suggest>
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
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default" @click.prevent="cancel">Cancel</button>
              <span class="pull-right">
                <button type="submit" class="btn btn-info" @click.prevent="submittoimage" v-if="!internalid">Save hand and upload image</button>
                <button type="submit" class="btn btn-info" @click.prevent="submit">Save hand</button>
              </span>
            </div>
          </form>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a hand. Please ask for them if you want to contribute to the database.
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="nav-tabs-custom" v-if="canedit">
          <ul class="nav nav-tabs pull-right">
            <li id="li_fromselected"><a href="#tab_fromselected" data-toggle="tab" aria-expanded="false">From selected posture</a></li>
            <li id="li_fromall" class="active"><a href="#tab_fromall" data-toggle="tab" aria-expanded="false">From all postures</a></li>
            <li class="pull-left header"><i class="fa fa-map-signs"></i> Suggestions</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="tab_fromselected">
              <i>Click on the selected line to automatically fill the fields with these values.</i>
              <div class="row">
                <div class="col-md-6">
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

import AutoSuggest from './../atomic/AutoSuggest'

export default {
  name: 'FormHand',
  components: {
    AutoSuggest
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
      failure: false,
      noeditableelement: false,
      pageDescriptionsAll: 0,
      filterDescriptionsAll: '',
      pageDescriptionsSelected: 0,
      filterDescriptionsSelected: '',
      willsubmittoimage: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['boxes', 'nendoroids', 'hands', 'canedit',
      'handsPostureCodeList', 'handsLeftRightCodeList', 'handsSkinColorCodeList']),
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
      return this.$route.name === 'Edit hand' ? this.$route.params.id : null
    },
    frompart () {
      return this.$route.params.frompart
    },
    descriptionSuggestionsSelected () {
      if (this.posture) {
        return this.hands
          .filter(a => a.posture === this.posture)
          .filter(a => a.description.toLowerCase().indexOf(this.filterDescriptionsSelected.toLowerCase()) > -1)
          .sort(this.dateSort)
          .map(b => b.description)
          .filter((elem, pos, arr) => elem && arr.indexOf(elem) === pos)
      }
      return []
    },
    descriptionSuggestionsAll () {
      return this.hands
        .concat()
        .filter(a => a.description.toLowerCase().indexOf(this.filterDescriptionsAll.toLowerCase()) > -1)
        .sort(this.dateSort)
        .map(b => b.description)
        .filter((elem, pos, arr) => elem && arr.indexOf(elem) === pos)
    }
  },
  watch: {
    internalid () {
      this.cancel()
    },
    posture () {
      this.changePosture()
      $('')
    }
  },
  methods: {
    ...Vuex.mapActions(['createHand', 'updateHand']),
    retrieveHandParams () {
      if (this.internalid) {
        console.log('Hand Edition mode')
        let hand = this.hands.find(hand => hand.internalid === this.$route.params.id)
        if (hand) {
          this.boxselected = hand.boxid ? hand.boxid : 'box'
          this.nendoroidselected = hand.nendoroidid ? hand.nendoroidid : 'nendoroid'
          this.posture = hand.posture
          this.leftright = hand.leftright
          this.skincolor = hand.skin_color
          this.description = hand.description
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
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
    submittoimage () {
      this.willsubmittoimage = true
      this.submit()
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
            if (this.willsubmittoimage) {
              router.push('/hand/' + response + '/edit/image/1')
            } else {
              router.push('/hand/' + response)
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
    changePageDescriptionsAll (newPageDescriptionsAll) {
      this.pageDescriptionsAll = newPageDescriptionsAll
    },
    changePageDescriptionsSelected (newPageDescriptionsSelected) {
      this.pageDescriptionsSelected = newPageDescriptionsSelected
    },
    changePosture () {
      $('#li_fromselected').addClass('active')
      $('#tab_fromselected').addClass('active')
      $('#li_fromall').removeClass('active')
      $('#tab_fromall').removeClass('active')
    }
  },
  mounted () {
    this.cancel()
    if (this.frompart === 'box') {
      this.boxselected = this.$route.params.fromid
    }
    if (this.frompart === 'nendoroid') {
      this.boxselected = this.nendoroids.find(nendoroid => nendoroid.internalid === this.$route.params.fromid).boxid
      this.nendoroidselected = this.$route.params.fromid
    }
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
