<template>
  <div class="row">
    <div class="col-md-12">
      <div class="box collapsed-box">
        <app-box-header title="History" collapsable="true" collapsed="true" icon="fa-history" @docollapse="loadhistory"></app-box-header>
        <div class="box-body">
          <div class="overlay" v-if="historyloading">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
          <ul class="timeline" v-else>
            <template v-for="(historyitem, index) in history">
              <li class="time-label" v-if="determineifneednewdate(index)" :key="historyitem.internalid">
                  <span class="bg-orange">
                      {{ historyitem.actiondate.split(' ')[0]  }}
                  </span>
              </li>
              <li :key="historyitem.internalid">
                  <i class="fa fa-plus bg-blue" v-if="historyitem.action === 'Creation'"></i>
                  <i class="fa fa-pencil bg-maroon" v-if="historyitem.action === 'Update'"></i>
                  <i class="fa fa-check-square-o bg-green" v-if="historyitem.action === 'Validation'"></i>
                  <i class="fa fa-square-o bg-red" v-if="historyitem.action === 'Unvalidation'"></i>
                  <i class="fa fa-image bg-purple" v-if="historyitem.action === 'Addition'"></i>
                  <div class="timeline-item">
                      <app-interval-component :date="historyitem.actiondate"></app-interval-component>

                      <h3 class="timeline-header"><router-link :to="'/user/'+historyitem.userid">{{ historyitem.username }}</router-link> ({{ historyitem.action }})</h3>

                      <div class="timeline-body">
                          {{ historyitem.detail }}
                      </div>

                      <div class="timeline-footer">
                          <router-link :to="'/box/'+historyitem.boxid" class="btn btn-primary btn-xs" v-if="historyitem.boxid"><i class="fa icon-icon_nendo_boxes"></i> Box</router-link>
                          <router-link :to="'/nendoroid/'+historyitem.nendoroidid" class="btn btn-primary btn-xs" v-if="historyitem.nendoroidid"><i class="fa icon-icon_nendo_nendo"></i> Nendoroid</router-link>
                          <router-link :to="'/face/'+historyitem.faceid" class="btn btn-primary btn-xs" v-if="historyitem.faceid"><i class="fa icon-icon_nendo_face"></i> Face</router-link>
                          <router-link :to="'/hair/'+historyitem.hairid" class="btn btn-primary btn-xs" v-if="historyitem.hairid"><i class="fa icon-icon_nendo_hair"></i> Hair</router-link>
                          <router-link :to="'/hand/'+historyitem.handid" class="btn btn-primary btn-xs" v-if="historyitem.handid"><i class="fa icon-icon_nendo_hand"></i> Hand</router-link>
                          <router-link :to="'/bodypart/'+historyitem.bodypartid" class="btn btn-primary btn-xs" v-if="historyitem.bodypartid"><i class="fa icon-icon_nendo_body"></i> Bodypart</router-link>
                          <router-link :to="'/accessory/'+historyitem.accessoryid" class="btn btn-primary btn-xs" v-if="historyitem.accessoryid"><i class="fa icon-icon_nendo_accessories"></i> Accessory</router-link>
                          <router-link :to="'/photo/'+historyitem.photoid" class="btn btn-primary btn-xs" v-if="historyitem.photoid"><i class="fa fa-image"></i> Photo</router-link>
                      </div>
                  </div>
              </li>
            </template>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppBoxHeader from './../layouts/BoxHeader'
import AppIntervalComponent from './../layouts/IntervalComponent'

export default {
  name: 'HistoryBox',
  props: ['elementtype', 'internalid'],
  components: {
    AppBoxHeader,
    AppIntervalComponent
  },
  data () {
    return {
      history: null,
      historyloading: true,
      currenthistorydate: null
    }
  },
  methods: {
    loadhistory () {
      console.log('Try to retrieve history...')
      this.$http.get(this.elementtype + '/' + this.internalid + '/history').then(response => {
        console.log('History loaded...')
        this.history = response.body
        this.historyloading = false
      }, response => {
        console.log('History not loaded...')
      })
    },
    determineifneednewdate (index) {
      if (index === 0 || this.history[index].actiondate.split(' ')[0] !== this.history[index - 1].actiondate.split(' ')[0]) {
        return true
      }
      return false
    }
  }
}

</script>
