<template>
              <li class="item">
                <div class="product-img">
                  <img src="../../assets/default-50x50.gif" :alt="news.type">
                </div>
                <div class="product-info">
                  <router-link :to="'/news/' + news.internalid" class="product-title">
                    {{ news.title }}
                    <span class="label label-danger pull-right" :class="labeltype">{{ news.type.toUpperCase() }}</span>
                  </router-link>
                  <span class="product-description">
                    {{ news.summary }}
                  </span>
                  <span>
                    <app-interval-component :date="news.creationdate"></app-interval-component> - <db-user-component :userid="news.authorid"></db-user-component>
                  </span>
                </div>
              </li>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import AppIntervalComponent from './../layouts/IntervalComponent'
import DbUserComponent from './../dblayouts/UserComponent'

import Resources from './../../config/resources'

export default {
  name: 'NewsTile',
  props: ['news'],
  store: store,
  components: {
    AppIntervalComponent,
    DbUserComponent
  },
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters([]),
    labeltype () {
      if (this.news.type === 'news') {
        return 'label-warning'
      } else if (this.news.type === 'article') {
        return 'label-danger'
      } else {
        return 'label-primary'
      }
    }
  },
  methods: {
  },
  mounted () {
  },
  updated () {
    $('[data-toggle="tooltip"]').tooltip('fixTitle')
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
