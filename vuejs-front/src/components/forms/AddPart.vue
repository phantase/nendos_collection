<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              Choose the part
            </h3>
          </div>
          <div class="box-body">
            <div class="btn-group">
              <router-link :to="'/nendoroid/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" v-if="frompart!=='nendoroid'" ><i class="fa icon-icon_nendo_nendo"></i>Nendoroid</button></router-link>
              <router-link :to="'/face/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" ><i class="fa icon-icon_nendo_face"></i>Face</button></router-link>
              <router-link :to="'/hair/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" ><i class="fa icon-icon_nendo_hair"></i>Hair</button></router-link>
              <router-link :to="'/hand/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" ><i class="fa icon-icon_nendo_hand"></i>Hand</button></router-link>
              <router-link :to="'/bodypart/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" ><i class="fa icon-icon_nendo_body"></i>Bodypart</button></router-link>
              <router-link :to="'/accessory/add/from/'+frompart+'/'+parentid"><button class="btn btn-app" ><i class="fa icon-icon_nendo_accessories"></i>Accessory</button></router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'AddPart',
  components: {
  },
  data () {
    return {
    }
  },
  computed: {
    parentid () {
      return this.$route.params.id
    },
    frompart () {
      return this.$route.meta.frompart
    }
  }
}
</script>
