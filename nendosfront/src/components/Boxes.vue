<template>
  <div class="boxes">

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12" v-for="box in boxes">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="box-category text-yellow">{{ box.category}}</div>
              <div class="box-name">{{ box.name }}</div>
              <div class="box-series">{{ box.series }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="resources.imagesurl+'/images/nendos/boxes/'+box.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>

</template>

<script>
import Resources from './../config/resources'

export default {
  name: 'Boxes',
  data () {
    return {
      resources: Resources,
      boxes: []
    }
  },
  mounted () {
    this.$boxes = this.$resource('boxes{/id}')
    this.$boxes.query().then((response) => {
      this.boxes = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>

<style>
  .box-category {
    font-weight: bold;
  }
  .box-series {
    font-style: italic;
  }
</style>
