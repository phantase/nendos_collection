<template>
  <div class="home">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/boxes">
          <app-info-box title="Boxes" color="bg-yellow" icon="icon-icon_nendo_boxes" :count="counts.boxes" :usercount="usercounts.boxes"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/nendoroids">
          <app-info-box title="Nendoroids" color="bg-yellow" icon="icon-icon_nendo_nendo" :count="counts.nendoroids" :usercount="usercounts.nendoroids"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/faces">
          <app-info-box title="Faces" color="bg-yellow" icon="icon-icon_nendo_face" :count="counts.faces" :usercount="usercounts.faces"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hairs">
          <app-info-box title="Hairs" color="bg-yellow" icon="icon-icon_nendo_hair" :count="counts.hairs" :usercount="usercounts.hairs"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hands">
          <app-info-box title="Hands" color="bg-yellow" icon="icon-icon_nendo_hand" :count="counts.hands" :usercount="usercounts.hands"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/bodyparts">
          <app-info-box title="Bodyparts" color="bg-yellow" icon="icon-icon_nendo_body" :count="counts.bodyparts" :usercount="usercounts.bodyparts"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/accessories">
          <app-info-box title="Accessories" color="bg-yellow" icon="icon-icon_nendo_accessories" :count="counts.accessories" :usercount="usercounts.accessories"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/photos">
          <app-info-box title="Photos" color="bg-yellow" icon="fa-photo" :count="counts.photos" :usercount="usercounts.photos"></app-info-box>
        </router-link>
      </div>
    </div>

  </div>
</template>

<script>
  import AppInfoBox from './dblayouts/InfoBox'
  import AppInfoBox1 from './layouts/InfoBox'

  export default {
    name: 'Home',
    components: {
      AppInfoBox,
      AppInfoBox1
    },
    data () {
      return {
        counts: {
          boxes: null,
          nendoroids: null,
          faces: null,
          hairs: null,
          hands: null,
          bodyparts: null,
          accessories: null,
          photos: null
        },
        usercounts: {
          boxes: null,
          nendoroids: null,
          faces: null,
          hairs: null,
          hands: null,
          bodyparts: null,
          accessories: null,
          photos: null
        }
      }
    },
    mounted () {
      this.$counts = this.$resource('count')
      this.$counts.query().then((response) => {
        this.counts = response.data.counts
        if (response.data.usercounts) {
          this.usercounts = response.data.usercounts
        }
      }, (response) => {
        console.log('Error', response)
      })
    }
  }
</script>
