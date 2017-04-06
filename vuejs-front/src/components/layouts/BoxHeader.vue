<template>
  <div class="box-header with-border">
    <h3 class="box-title"><i v-if="icon" class="fa" :class="icon"></i> {{ title }}</h3>
    <div class="box-tools pull-right" v-if="collapsable || editable">
      <router-link :to="editlink" class="btn btn-box-tool" data-toggle="tooltip" title="Edit" v-if="editable"><i class="fa fa-edit"></i></router-link>
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" v-if="collapsable" @click.once="docollapse"><i class="fa" :class="collapsed?'fa-plus':'fa-minus'"></i></button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BoxHeader',
  props: ['title', 'collapsable', 'collapsed', 'icon', 'editable', 'editlink'],
  data () {
    return {
    }
  },
  methods: {
    docollapse () {
      this.$emit('docollapse')
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}
</script>
