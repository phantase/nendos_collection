<template>
  <div class="db-box" v-if="singleNews">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <router-link :to="'/news/'+singleNews.internalid+'/edit'" class="btn btn-xs bg-blue pull-right" v-if="canadmin"><i class="fa fa-edit"></i> Edit</router-link>
              <div class="product-img pull-left">
                <img src="../assets/default-50x50.gif" :alt="singleNews.type">
              </div>
              <div class="db-news-title">{{ singleNews.title }}</div>
              <div class="db-news-creationdate"><app-interval-component :date="singleNews.creationdate"></app-interval-component></div>
              <div class="db-news-author"><db-user-component :userid="singleNews.authorid"></db-user-component></div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="News" collapsable="true" icon="fa-newspaper-o"></app-box-header>
          <div class="box-body" v-html="singleNews.content">
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
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import AppIntervalComponent from './layouts/IntervalComponent'
import DbUserComponent from './dblayouts/UserComponent'

export default {
  name: 'SingleNews',
  components: {
    AppBoxHeader,
    AppIntervalComponent,
    DbUserComponent
  },
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['news', 'authenticated', 'canadmin']),
    singleNews () {
      return this.news.find(singlenews => singlenews.internalid === this.$route.params.id)
    }
  },
  methods: {
    ...Vuex.mapActions([])
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      document.title += ' / ' + vm.singleNews.title + ' / Id: ' + vm.singleNews.internalid
    })
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
