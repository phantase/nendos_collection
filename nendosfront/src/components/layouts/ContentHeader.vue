<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ pageheader }}
        <small>{{ pagedescription }}</small>
      </h1>
      <ol class="breadcrumb" v-show="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>
</template>

<script>
  export default {
    name: 'ContentHeader',
    props: ['pageheader', 'pagedescription', 'breadcrumb'],
    data () {
      return {
      }
    }
  }
</script>
