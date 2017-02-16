<template>
  <div class="db-box" v-if="nendoroid.internalid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="db-nendoroid-name">{{ nendoroid.name }}</div>
              <div class="db-nendoroid-version">{{ nendoroid.version ? nendoroid.version : '&nbsp;' }}</div>
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
              <li class="list-group-item" v-if="nendoroid.boxid">
                <b>From box</b>
                <router-link :to="'/box/'+nendoroid.boxid" class="pull-right">{{ nendoroid.boxid }}</a><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.name">
                <b>Name</b>
                <a class="pull-right">{{ nendoroid.name }}</a><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.version">
                <b>Version</b>
                <a class="pull-right">{{ nendoroid.version }}</a><br>
              </li>
              <li class="list-group-item" v-if="nendoroid.sex">
                <b>Sex</b>
                <a class="pull-right">{{ nendoroid.sex }}</a><br>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box">
          <app-box-header title="Photo" collapsable="true" icon="fa-photo"></app-box-header>
          <div class="box-body db-image">
            <img :src="resources.imagesurl+'/images/nendos/nendoroids/'+nendoroid.internalid+'_thumb'" />
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
  name: 'Nendoroid',
  components: {
    AppBoxHeader
  },
  data () {
    return {
      resources: Resources,
      nendoroid: []
    }
  },
  mounted () {
    this.$nendoroids = this.$resource('nendoroids{/id}')
    this.$nendoroids.query({id: this.$route.params.id}).then((response) => {
      this.nendoroid = response.data
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
