<template>
  <div class="row">
    <router-link tag="div" :to="'/box/'+box.internalid" class="col-md-3 col-sm-6 col-xs-12" v-for="box in boxes">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-box-category text-yellow">
              <span>{{ box.category}}</span>
              <span v-if="box.number">#{{ box.number}}</span>
            </div>
            <div class="db-box-name">{{ box.name }}</div>
            <div class="db-box-series">{{ box.series ? box.series : '&nbsp;' }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
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
  props: ['boxes'],
  data () {
    return {
      resources: Resources
    }
  }
}

</script>
