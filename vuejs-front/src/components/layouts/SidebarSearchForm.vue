<template>
      <!-- search form (Optional) -->
      <form class="sidebar-form">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search..." v-model="queryTerm">
              <span class="input-group-btn">
                <button type="button" @click="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
</template>

<script>
  import router from './../../router'
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'SidebarSearchForm',
    store: store,
    data () {
      return {
        queryTerm: null
      }
    },
    methods: {
      ...Vuex.mapActions(['setSearchTerm']),
      submit () {
        this.setSearchTerm(this.queryTerm)
        router.push('/search')
        this.queryTerm = null
      }
    }
  }
</script>
