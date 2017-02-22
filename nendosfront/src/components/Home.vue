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
        counts: [],
        usercounts: []
      }
    },
    computed: {
      info_boxes () {
        return {
          title: 'Boxes',
          message: this.counts ? this.counts.boxes : '',
          icon: 'icon-icon_nendo_boxes',
          color: 'bg-yellow'
        }
      },
      info_nendoroids () {
        return {
          title: 'Nendoroids',
          message: this.counts ? this.counts.nendoroids : '',
          icon: 'icon-icon_nendo_nendo',
          color: 'bg-yellow'
        }
      },
      info_faces () {
        return {
          title: 'Faces',
          message: this.counts ? this.counts.faces : '',
          icon: 'icon-icon_nendo_face',
          color: 'bg-yellow'
        }
      },
      info_hairs () {
        return {
          title: 'Hairs',
          message: this.counts ? this.counts.hairs : '',
          icon: 'icon-icon_nendo_hair',
          color: 'bg-yellow'
        }
      },
      info_hands () {
        return {
          title: 'Hands',
          message: this.counts ? this.counts.hands : '',
          icon: 'icon-icon_nendo_hand',
          color: 'bg-yellow'
        }
      },
      info_bodyparts () {
        return {
          title: 'Bodyparts',
          message: this.counts ? this.counts.bodyparts : '',
          icon: 'icon-icon_nendo_body',
          color: 'bg-yellow'
        }
      },
      info_accessories () {
        return {
          title: 'Accessories',
          message: this.counts ? this.counts.accessories : '',
          icon: 'icon-icon_nendo_accessories',
          color: 'bg-yellow'
        }
      },
      info_photos () {
        return {
          title: 'Photos',
          message: this.counts ? this.counts.photos : '',
          icon: 'fa-photo',
          color: 'bg-yellow'
        }
      }
    },
    mounted () {
      this.$counts = this.$resource('count')
      this.$counts.query().then((response) => {
        this.counts = response.data.counts
      }, (response) => {
        console.log('Error', response)
      })
    }
  }
</script>
