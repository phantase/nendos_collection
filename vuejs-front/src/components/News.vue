<template>
  <div class="db-accessories">
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="Sorting and filtering" collapsable="true" collapsed="true" icon="fa-filter"></app-box-header>
          <div class="box-body">
            <div class="pull-left">
              <span>
                <label>Type: </label>
                <select v-model="filtertype">
                  <option value="all">All</option>
                  <option value="news">News</option>
                  <option value="article">Article</option>
                  <option value="comment">Comment</option>
                </select>
              </span>
            </div>
            <div class="pull-right">
              <label>Sort by: </label>
              <select v-model="orderedby">
                <option value="creationdate">Date</option>
                <option value="title">Title</option>
                <option value="author">Author</option>
                <option value="popularity">Popularity</option>
              </select>
              <select v-model="direction">
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-warning">
          <app-box-header title="News" collapsable="true" icon="fa-newspaper-o"></app-box-header>
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <app-news-tile v-for="singleNews in displayedNews"
                              :type="singleNews.type" :date="singleNews.creationdate" :userid="singleNews.authorid"
                              :title="singleNews.title"
                              :summary="singleNews.summary"></app-news-tile>
            </ul>
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
import AppNewsTile from './dblayouts/NewsTile'

export default {
  name: 'News',
  components: {
    AppBoxHeader,
    AppNewsTile
  },
  store: store,
  data () {
    return {
      resources: Resources,
      filtertype: 'all',
      orderedby: 'creationdate',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['news']),
    displayedNews () {
      return this.news.concat().sort(function (a, b) {
        return new Date(b.creationdate).getTime() - new Date(a.creationdate).getTime()
      })
    }
  },
  methods: {
  }
}
</script>
