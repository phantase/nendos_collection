<template>
  <div class="home">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/boxes">
          <app-info-box title="Boxes" color="bg-yellow" icon="icon-icon_nendo_boxes" :count="countboxes" :usercount="countuserboxes"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/nendoroids">
          <app-info-box title="Nendoroids" color="bg-yellow" icon="icon-icon_nendo_nendo" :count="countnendoroids" :usercount="countusernendoroids"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/faces">
          <app-info-box title="Faces" color="bg-yellow" icon="icon-icon_nendo_face" :count="countfaces" :usercount="countuserfaces"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hairs">
          <app-info-box title="Hairs" color="bg-yellow" icon="icon-icon_nendo_hair" :count="counthairs" :usercount="countuserhairs"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hands">
          <app-info-box title="Hands" color="bg-yellow" icon="icon-icon_nendo_hand" :count="counthands" :usercount="countuserhands"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/bodyparts">
          <app-info-box title="Bodyparts" color="bg-yellow" icon="icon-icon_nendo_body" :count="countbodyparts" :usercount="countuserbodyparts"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/accessories">
          <app-info-box title="Accessories" color="bg-yellow" icon="icon-icon_nendo_accessories" :count="countaccessories" :usercount="countuseraccessories"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/photos">
          <app-info-box title="Photos" color="bg-yellow" icon="fa-photo" :count="countphotos"></app-info-box>
        </router-link>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="box box-warning">
          <app-box-header title="Latest news" collapsable="true" icon="fa-newspaper-o"></app-box-header>
          <div class="box-body">
            <ul class="products-list product-list-in-box">
              <app-news-tile type="news"
                              title="A title for a news"
                              summary="Flexeris per fabulae aetatem gyris iam exprimunt fabulae iactari quae innumera cirratas multas innumera cirratas."></app-news-tile>
              <app-news-tile type="article"
                              title="An article and its title"
                              summary="Sequi minori est improborum omni sit hodie improborum an quis concessum talis sed quod concessum."></app-news-tile>
              <app-news-tile type="comment"
                              title="The title of a comment"
                              summary="Quod non qui magis quod Quis altero numquam viderit etiam propter quis quodam nihil Fabrici."></app-news-tile>
            </ul>
          </div>
          <div class="box-footer text-center">
            <router-link to="/news" class="uppercase">View all news</router-link>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import store from './../store'
  import Vuex from 'vuex'

  import AppBoxHeader from './layouts/BoxHeader'
  import AppInfoBox from './dblayouts/InfoBox'
  import AppNewsTile from './dblayouts/NewsTile'

  export default {
    name: 'Home',
    components: {
      AppBoxHeader,
      AppInfoBox,
      AppNewsTile
    },
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters([
        'countboxes', 'countuserboxes',
        'countnendoroids', 'countusernendoroids',
        'countfaces', 'countuserfaces',
        'counthairs', 'countuserhairs',
        'counthands', 'countuserhands',
        'countbodyparts', 'countuserbodyparts',
        'countaccessories', 'countuseraccessories',
        'countphotos'
      ])
    }
  }
</script>
