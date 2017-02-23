<template>
  <div class="row">
    <router-link :to="'/nendoroid/'+nendoroid.internalid" :class="classtiles" v-for="nendoroid in nendoroids">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-nendoroid-name" data-toggle="tooltip" :title="nendoroid.name">{{ nendoroid.name }}</div>
            <div class="db-nendoroid-version" data-toggle="tooltip" :title="nendoroid.version">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-nendoroid-name'>`+nendoroid.name+`</div>
                        <div class='db-nendoroid-version'>`+(nendoroid.version ? nendoroid.version : '')+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
          <span class="badge bg-blue incollection" v-if="nendoroid.colladdeddate">{{ nendoroid.collquantity }}</span>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'NendoroidsTiles',
  props: ['nendoroids', 'tilessize'],
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-6 col-sm-6 col-xs-12'
      } else {
        return 'col-md-3 col-sm-6 col-xs-12'
      }
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
