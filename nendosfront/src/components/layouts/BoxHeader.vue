<template>
  <div class="box-header with-border">
    <h3 class="box-title"><i v-if="icon" class="fa" :class="icon"></i> {{ title }}</h3>
    <div class="box-tools pull-right" v-if="collapsable">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BoxHeader',
  props: ['title', 'collapsable', 'icon'],
  data () {
    return {
    }
  }
}
</script>
