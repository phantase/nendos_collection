<template>
  <div class="row">
    <div class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-hand-internalid">{{ hand.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/hands/'+hand.internalid+'_thumb'" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'HandsTiles',
  props: ['hands'],
  data () {
    return {
      resources: Resources
    }
  }
}

</script>
