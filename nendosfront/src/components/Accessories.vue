<template>
  <div class="accessories">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="accessory in accessories">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="accessory-internalid">{{ accessory.internalid }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/accessories/'+accessory.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Accessories',
  data () {
    return {
      accessories: []
    }
  },
  mounted () {
    this.$accessories = this.$resource('accessories{/id}')
    this.$accessories.query().then((response) => {
      this.accessories = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
