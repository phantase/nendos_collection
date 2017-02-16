<template>
  <div class="db-box" v-if="box.internalid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-box-category text-yellow">
                <span>{{ box.category}}</span>
                <span v-if="box.number">#{{ box.number}}</span>
              </div>
              <div class="db-box-name">{{ box.name }}</div>
              <div class="db-box-series">{{ box.series }}</div>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Informations" collapsable="true" icon="fa-info"></app-box-header>
          <div class="box-body">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item" v-if="box.number">
                <b>Number</b>
                <a class="pull-right">{{ box.number }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.name">
                <b>Name</b>
                <a class="pull-right">{{ box.name }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.series">
                <b>Series</b>
                <a class="pull-right">{{ box.series }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.manufacturer">
                <b>Manufacturer</b>
                <a class="pull-right">{{ box.manufacturer }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.price">
                <b>Price ¥</b>
                <a class="pull-right">{{ box.price }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.category">
                <b>Category</b>
                <a class="pull-right">{{ box.category }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.releasedate">
                <b>Release date</b>
                <a class="pull-right">{{ box.releasedate }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.specifications">
                <b>Specifications</b>
                <a class="pull-right">{{ box.specifications }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.sculptor">
                <b>Sculptor</b>
                <a class="pull-right">{{ box.sculptor }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.cooperation">
                <b>Cooperation</b>
                <a class="pull-right">{{ box.cooperation }}</a><br>
              </li>
              <li class="list-group-item" v-if="box.officialurl">
                <b>Links</b>
                <a class="pull-right" :href="box.officialurl">GSC product page</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/boxes/'+box.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Resources from './../config/resources'
import AppBoxHeader from './layouts/BoxHeader'

export default {
  name: 'Box',
  components: {
    AppBoxHeader
  },
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

<style scoped>
  .list-group-item a {
    width: calc(100% - 8em);
    text-align: right;
  }
  .pull-right+br {
    clear: both;
  }
</style>
