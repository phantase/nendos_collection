<template>
  <div class="row" v-if="authenticated || viewvalidation">
    <div :class="viewvalidation?'col-md-6':'col-md-12'">
      <div class="box">
        <div class="box-body">
          <span v-if="collquantity">
            <span class="btn btn-xs pull-right bg-green" @click="collect"><i class="fa fa-plus"></i></span>
            <span class="badge pull-right bg-blue givemespace">{{ collquantity }}</span>
            <span class="btn btn-xs pull-right bg-red" @click="uncollect"><i class="fa fa-minus"></i></span>
            You own {{ collquantity }} cop{{ collquantity > 1 ? 'ies' : 'y' }}
          </span>
          <span v-else>
            <span class="btn btn-xs pull-right bg-green" @click="collect"><i class="fa fa-plus"></i></span>
            <span class="badge pull-right bg-blue givemespace">0</span>
            <span class="btn btn-xs pull-right bg-red disabled"><i class="fa fa-minus"></i></span>
            You don't own this
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-6" v-if="viewvalidation">
      <div class="box">
        <div class="box-body">
          <span v-if="validatorname">
            <span class="btn btn-xs bg-red pull-right" @click="unvalidate"v-if="canvalidate">Unvalidate</span>
            <span class="badge pull-right bg-green" v-else>V</span>
            Validated by <i>{{validatorname}}</i>
          </span>
          <span v-else>
            <span class="btn btn-xs bg-green pull-right" @click="validate" v-if="canvalidate">Validate</span>
            <span class="badge pull-right bg-red" v-else>NV</span>
            Not validated
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from './../../store'
import Vuex from 'vuex'

export default {
  name: 'CollectionAndValidationTile',
  props: ['colladdeddate', 'collquantity', 'validatorname'],
  store: store,
  data () {
    return {
    }
  },
  computed: {
    ...Vuex.mapGetters(['authenticated', 'viewvalidation', 'canvalidate'])
  },
  methods: {
    collect () {
      this.$emit('collect')
    },
    uncollect () {
      this.$emit('uncollect')
    },
    validate () {
      this.$emit('validate')
    },
    unvalidate () {
      this.$emit('unvalidate')
    }
  }
}

</script>

<style scoped>
  .givemespace {
    margin-left: 2px;
    margin-right: 2px;
  }
</style>
