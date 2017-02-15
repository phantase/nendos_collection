<template>
  <div class="faces">

    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-6" v-for="face in faces">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">
              <div class="face-internalid">{{ face.internalid }}</div>
            </h3>
          </div>
          <div class="box-body">
            <img :src="'http://localhost/images/nendos/faces/'+face.internalid+'_thumb'" />
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Faces',
  data () {
    return {
      faces: []
    }
  },
  mounted () {
    this.$faces = this.$resource('faces{/id}')
    this.$faces.query().then((response) => {
      this.faces = response.data
    }, (response) => {
      console.log('Error', response)
    })
  }
}
</script>
