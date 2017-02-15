<template>
  <div class="home">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/boxes">
          <app-info-box :info="info_boxes"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/nendoroids">
          <app-info-box :info="info_nendoroids"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/faces">
          <app-info-box :info="info_faces"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hairs">
          <app-info-box :info="info_hairs"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/hands">
          <app-info-box :info="info_hands"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/bodyparts">
          <app-info-box :info="info_bodyparts"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/accessories">
          <app-info-box :info="info_accessories"></app-info-box>
        </router-link>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <router-link to="/photos">
          <app-info-box :info="info_photos"></app-info-box>
        </router-link>
      </div>
    </div>

  </div>
</template>

<script>
  import AppInfoBox from './layouts/InfoBox'

  export default {
    name: 'Home',
    components: {
      AppInfoBox
    },
    data () {
      return {
        info_boxes: {
          title: 'Boxes',
          message: '0',
          icon: 'icon-icon_nendo_boxes',
          color: 'bg-yellow'
        },
        info_nendoroids: {
          title: 'Nendoroids',
          message: '0',
          icon: 'icon-icon_nendo_nendo',
          color: 'bg-yellow'
        },
        info_faces: {
          title: 'Faces',
          message: '0',
          icon: 'icon-icon_nendo_face',
          color: 'bg-yellow'
        },
        info_hairs: {
          title: 'Hairs',
          message: '0',
          icon: 'icon-icon_nendo_hair',
          color: 'bg-yellow'
        },
        info_hands: {
          title: 'Hands',
          message: '0',
          icon: 'icon-icon_nendo_hand',
          color: 'bg-yellow'
        },
        info_bodyparts: {
          title: 'Bodyparts',
          message: '0',
          icon: 'icon-icon_nendo_body',
          color: 'bg-yellow'
        },
        info_accessories: {
          title: 'Accessories',
          message: '0',
          icon: 'icon-icon_nendo_accessories',
          color: 'bg-yellow'
        },
        info_photos: {
          title: 'Photos',
          message: '0',
          icon: 'fa-photo',
          color: 'bg-yellow'
        }
      }
    },
    mounted () {
      this.$counts = this.$resource('count')
      this.$counts.query().then((response) => {
        this.info_boxes.message = response.data.boxes
        this.info_nendoroids.message = response.data.nendoroids
        this.info_faces.message = response.data.faces
        this.info_hairs.message = response.data.hairs
        this.info_hands.message = response.data.hands
        this.info_bodyparts.message = response.data.bodyparts
        this.info_accessories.message = response.data.accessories
        this.info_photos.message = response.data.photos
      }, (response) => {
        console.log('Error', response)
      })
    }
  }
</script>
