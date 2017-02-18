<template>
  <div class="row">
    <router-link :to="'/box/'+box.internalid" :class="classtiles" v-for="box in boxes">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-box-category text-yellow" data-toggle="tooltip" :title="box.category+(box.number?' #'+box.number:'')">
              <span>{{ box.category}}</span>
              <span v-if="box.number">#{{ box.number}}</span>
            </div>
            <div class="db-box-name" data-toggle="tooltip" :title="box.name">{{ box.name }}</div>
            <div class="db-box-series" data-toggle="tooltip" :title="box.series">{{ box.series ? box.series : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-box-category text-yellow'>`+box.category+(box.number ? ' #'+box.number:'')+`</div>
                            <div class='db-box-name'>`+box.name+`</div>
                            <div class='db-box-series'>`+box.series+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/boxes/'+box.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'BoxesTiles',
  props: ['boxes', 'tilessize'],
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
