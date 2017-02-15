<template>
  <div class="hands">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="hand in hands">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="hand-internalid">{{ hand.internalid }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/hands/'+hand.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Hands',
  data () {
    return {
      hands: []
    }
  },
  mounted () {
    this.$hands = this.$resource('hands{/id}')
    this.$hands.query().then((response) => {
      this.hands = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
