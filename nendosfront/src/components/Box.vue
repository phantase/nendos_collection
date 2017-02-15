<template>
  <div class="app-box">
    <div class="box" v-if="box.internalid">
      <div class="box-header with-border">
        <h3 class="box-title">
          <div class="box-category text-yellow">
            <span>{{ box.category}}</span>
            <span v-if="box.number">#{{ box.number}}</span>
          </div>
          <div class="box-name">{{ box.name }}</div>
          <div class="box-series">{{ box.series }}</div>
        </h3>
      </div>
      <div class="box-body">
        <img :src="resources.imagesurl+'/images/nendos/boxes/'+box.internalid+'_thumb'" />
      </div>
    </div>
  </div>
</template>

<script>
import Resources from './../config/resources'

export default {
  name: 'Box',
  data () {
    return {
      resources: Resources,
      box: []
    }
  },
  mounted () {
    this.$boxes = this.$resource('boxes{/id}')
    this.$boxes.query({id: this.$route.params.id}).then((response) => {
      this.box = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
