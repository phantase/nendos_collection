<template>
  <div class="row">
    <router-link :to="'/accessory/'+accessory.internalid" :class="classtiles" v-for="accessory in accessories">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-accessory-internalid">{{ accessory.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-accessory-type text-yellow'>`+accessory.type+`</div>
                        <div class='db-accessory-description'><span class='text-yellow'>Description:</span> `+accessory.description+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/accessories/'+accessory.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'AccessoriesTiles',
  props: ['accessories', 'tilessize'],
  data () {
    return {
      resources: Resources
    }
  },
  computed: {
    classtiles () {
      if (typeof this.tilessize !== 'undefined' && this.tilessize === 'big') {
        return 'col-md-4 col-sm-6 col-xs-6'
      } else {
        return 'col-md-2 col-sm-4 col-xs-6'
      }
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}

</script>
