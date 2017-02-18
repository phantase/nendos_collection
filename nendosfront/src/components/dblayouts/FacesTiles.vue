<template>
  <div class="row">
    <router-link :to="'/face/'+face.internalid" :class="classtiles" v-for="face in faces">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <div class="db-face-internalid">{{ face.internalid }}</div>
          </h3>
        </div>
        <div class="box-body db-image"
              data-toggle="tooltip" data-html="true"
              :title="`<div class='db-face-eyes'><span class='text-yellow'>Eyes:</span> `+face.eyes+`</div>
                        <div class='db-face-mouth'><span class='text-yellow'>Mouth:</span> `+face.mouth+`</div>`">
          <img :src="resources.imagesurl+'/images/nendos/faces/'+face.internalid+'_thumb'" />
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
import Resources from './../../config/resources'

export default {
  name: 'FacesTiles',
  props: ['faces', 'tilessize'],
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
