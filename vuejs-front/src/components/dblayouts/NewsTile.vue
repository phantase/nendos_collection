<template>
              <li class="item">
                <div class="product-img">
                  <img src="../../assets/default-50x50.gif" :alt="type">
                </div>
                <div class="product-info">
                  <router-link to="/news/2" class="product-title">
                    {{ title }}
                    <span class="label label-danger pull-right" :class="labeltype">{{ type.toUpperCase() }}</span>
                  </router-link>
                  <span class="product-description">
                    {{ summary }}
                  </span>
                  <span>
                    <app-interval-component :date="date"></app-interval-component> - <router-link :to="'/profile/' + user.internalid" v-if="user">{{ user.username }}</router-link>
                  </span>
                </div>
              </li>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import AppIntervalComponent from './../layouts/IntervalComponent'

import Resources from './../../config/resources'

export default {
  name: 'NewsTile',
  props: ['type', 'title', 'summary', 'date', 'userid'],
  store: store,
  components: {
    AppIntervalComponent
  },
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['users']),
    user () {
      return this.users.find(user => user.internalid === this.userid)
    },
    labeltype () {
      if (this.type === 'news') {
        return 'label-warning'
      } else if (this.type === 'article') {
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
