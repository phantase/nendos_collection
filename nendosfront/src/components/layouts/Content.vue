<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <app-content-header :pageheader="pageheader" :pagedescription="pagedescription"></app-content-header>

    <!-- Main content -->
    <section class="content">

    <router-view></router-view>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
</template>

<script>
  import AppContentHeader from './ContentHeader'

  export default {
    name: 'Content',
    components: {
      AppContentHeader
    },
    data () {
      return {
      }
    },
    computed: {
      pageheader () {
        return this.$route.name
      },
      pagedescription () {
        return this.$route.meta.description
      }
    }
  }
</script>
