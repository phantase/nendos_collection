<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ pageheader }}
        <small>{{ pagedescription }}</small>
      </h1>
      <ol class="breadcrumb">
        <li v-if="pageheader != 'Home' ">
          <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
        </li>
        <li v-for="page in breadcrumb">
          <router-link :to="computeLink(page.link)">{{ page.title }}</router-link>
        </li>
        <li class="active">{{ pageheader }}</li>
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
    },
    methods: {
      computeLink (initlink) {
        if (initlink.indexOf(':id') > -1 && this.$route.params.id) {
          return initlink.replace(':id', this.$route.params.id)
        }
        return initlink
      }
    }
  }
</script>
