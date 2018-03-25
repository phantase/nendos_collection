<template>
  <div class="db-box" v-if="!noeditableelement">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-newspaper-o"></i> {{ internalid ? 'Edit' : 'Add' }} a news</h3>
          </div>
          <form role="form" v-if="canadmin">
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <div class="form-group" :class="errortitle?'has-error':''">
                    <label>Title</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Title" v-model="title">
                    <span class="help-block" v-if="errortitle">The title is mandatory</span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="form-group" :class="errortype?'has-error':''">
                    <label>Type</label>
                    <select v-model="type" class="form-control">
                      <option value="Site News">Site News</option>
                      <option value="Content News">Content News</option>
                      <option value="Nendoroid News">Nendoroid News</option>
                      <option value="Article">Article</option>
                      <option value="Other">Other</option>
                    </select>
                    <span class="help-block" v-if="errortype">The type is mandatory</span>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group" :class="errorsummary?'has-error':''">
                    <label>Summary</label>
                    <input type="text" class="form-control" maxlength="100" placeholder="Summary" v-model="summary">
                    <span class="help-block" v-if="errorsummary">The summary is mandatory</span>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
                  <div class="form-group" :class="errorcontent?'has-error':''">
                    <label>Content</label>
                    <textarea id="content-wyg" v-model="content"></textarea>
                    <span class="help-block" v-if="errorcontent">The content is mandatory</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default" @click.prevent="cancel">Cancel</button>
              <button type="submit" class="btn btn-info pull-right" @click.prevent="submit">Save news</button>
            </div>
          </form>
          <div class="box-body" v-else>
            <div class="alert alert-danger">
              <h4><i class="icon fa fa-ban"></i> Not authorized!</h4>
              You don't have the rights to add or edit a news.
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

import AppBoxHeader from './../layouts/BoxHeader'
import AppIntervalComponent from './../layouts/IntervalComponent'
import DbUserComponent from './../dblayouts/UserComponent'

export default {
  name: 'FormSingleNews',
  components: {
    AppBoxHeader,
    AppIntervalComponent,
    DbUserComponent
  },
  store: store,
  data () {
    return {
      resources: Resources,
      title: null,
      type: null,
      summary: null,
      content: null,
      errortitle: false,
      errortype: false,
      errorsummary: false,
      errorcontent: false,
      noeditableelement: false
    }
  },
  computed: {
    ...Vuex.mapGetters(['news', 'canadmin']),
    internalid () {
      return this.$route.name === 'Edit news' ? this.$route.params.id : null
    }
  },
  watch: {
    internalid () {
      this.cancel()
    }
  },
  methods: {
    ...Vuex.mapActions(['createNews', 'updateNews']),
    retrieveNewsParams () {
      if (this.internalid) {
        console.log('News Edition mode')
        let singleNews = this.news.find(singlenews => singlenews.internalid === this.internalid)
        if (singleNews) {
          this.title = singleNews.title
          this.type = singleNews.type
          this.summary = singleNews.summary
          this.content = singleNews.content
          this.noeditableelement = false
        } else {
          this.noeditableelement = true
        }
      } else {
        console.log('News Addition mode')
      }
      $('#content-wyg').trumbowyg('html', this.content)
    },
    cancel () {
      this.title = null
      this.type = null
      this.summary = null
      this.content = null
      this.errortitle = false
      this.errorsummary = false
      $('#content-wyg').trumbowyg('empty')
      this.retrieveNewsParams()
    },
    checkForm () {
      if (this.title === null) {
        this.errortitle = true
      } else {
        this.errortitle = false
      }
      if (this.type === null) {
        this.errortype = true
      } else {
        this.errortype = false
      }
      if (this.summary === null) {
        this.errorsummary = true
      } else {
        this.errorsummary = false
      }
    },
    submit () {
      console.log('Submit form')
      this.failure = false
      this.checkForm()
      if (this.errortitle || this.errorsummary) {
        console.log('Cannot submit')
      } else {
        console.log('Can submit')
        let body = {}
        let formData = new FormData()
        if (this.internalid) {
          body.internalid = this.internalid
          formData.append('internalid', this.internalid)
        }
        body.title = this.title
        formData.append('title', this.title)
        body.type = this.type
        formData.append('type', this.type)
        body.summary = this.summary
        formData.append('summary', this.summary)
        body.content = $('#content-wyg').trumbowyg('html')
        formData.append('content', $('#content-wyg').trumbowyg('html'))
        if (this.internalid) {
          this.updateNews({
            'context': this,
            'body': body,
            'internalid': this.internalid
          }).then(response => {
            console.log('Edition successful')
            router.push('/news/' + response)
          }, response => {
            console.log('Edition failed')
            this.failure = true
          })
        } else {
          this.createNews({
            'context': this,
            'formData': formData
          }).then(response => {
            console.log('Addition successful')
            router.push('/news/' + response)
          }, response => {
            console.log('Addition failed')
            this.failure = true
          })
        }
      }
    }
  },
  mounted () {
    $('#content-wyg').trumbowyg()
    this.cancel()
    // $('select').select2()
  },
  beforeUpdate () {
    // $('select').select2()
  }
}
</script>

<style scoped>
  .db-news-title {
    padding-left: 10px;
  }
  .db-news-creationdate {
    padding-left: 10px;
    padding-top: 2px;
    font-size: 0.7em;
  }
  .db-news-author {
    padding-left: 10px;
    padding-top: 2px;
    font-size: 0.7em;
  }
</style>
