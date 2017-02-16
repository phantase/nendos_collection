<template>
  <div class="row">
    <div class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-face-internalid">{{ face.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image">
          <img :src="resources.imagesurl+'/images/nendos/faces/'+face.internalid+'_thumb'" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'FacesTiles',
  props: ['faces'],
  data () {
    return {
      resources: Resources
    }
  }
}

</script>
