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
                </div>
              </li>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

import Resources from './../../config/resources'

export default {
  name: 'NewsTile',
  props: ['type', 'title', 'summary'],
  store: store,
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    ...Vuex.mapGetters(['viewvalidation']),
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
