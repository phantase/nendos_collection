<template>
  <div class="row">
    <router-link tag="div" :to="'/nendoroid/'+nendoroid.internalid" class="col-md-3 col-sm-6 col-xs-12" v-for="nendoroid in nendoroids">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-nendoroid-name">{{ nendoroid.name }}</div>
            <div class="db-nendoroid-version">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'NendoroidsTiles',
  props: ['nendoroids'],
  data () {
    return {
      resources: Resources
    }
  }
}

</script>
