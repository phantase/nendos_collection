<template>
  <div class="row" v-if="authenticated || viewvalidation">
    <div :class="viewvalidation?'col-md-6':'col-md-12'">
      <div class="box">
        <div class="box-body">
          <span v-if="colladdeddate">
            <span class="badge pull-right bg-blue">{{ collquantity }}</span>
            You own {{ collquantity }} cop{{ collquantity > 1 ? 'ies' : 'y' }}
          </span>
          <span v-else>
            <span class="badge pull-right bg-blue">0</span>
            <a href="#">Add box to collection</a>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-6" v-if="viewvalidation">
      <div class="box">
        <div class="box-body">
          <span v-if="validatorname">
            <span class="badge pull-right bg-green">V</span>
            Validated by <i>{{validatorname}}</i>
          </span>
          <span v-else>
            <span class="badge pull-right bg-red">NV</span>
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
    ...Vuex.mapGetters(['authenticated', 'viewvalidation'])
  }
}

</script>
