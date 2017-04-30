<template>
  <span class="time" data-toggle="tooltip" :title="date">
    <i class="fa fa-clock-o"></i> {{ interval }}
  </span>
</template>

<script>
export default {
  name: 'IntervalComponent',
  props: ['date'],
  data () {
    return {
    }
  },
  computed: {
    interval () {
      let jsdate = new Date(this.date)
      let jsnow = new Date()
      let intervalMS = jsnow.getTime() - jsdate.getTime()
      if (intervalMS < 1000 * 10) {
        return 'Right now'
      } else if (intervalMS < 1000 * 60) {
        return Math.round(intervalMS / (1000)) + ' seconds ago'
      } else if (intervalMS < 1000 * 60 * 60) {
        return Math.round(intervalMS / (1000 * 60)) + ' minutes ago'
      } else if (intervalMS < 1000 * 60 * 60 * 24) {
        return Math.round(intervalMS / (1000 * 60 * 60)) + ' hours ago'
      } else if (intervalMS < 1000 * 60 * 60 * 24 * 7) {
        return Math.round(intervalMS / (1000 * 60 * 60 * 24)) + ' days ago'
      } else if (intervalMS < 1000 * 60 * 60 * 24 * 31) {
        return Math.round(intervalMS / (1000 * 60 * 60 * 24 * 7)) + ' weeks ago'
      } else if (intervalMS < 1000 * 60 * 60 * 24 * 365) {
        return Math.round(intervalMS / (1000 * 60 * 60 * 24 * 30)) + ' months ago'
      }
      return Math.round(intervalMS / (1000 * 60 * 60 * 24 * 365)) + ' years ago'
    }
  },
  destroyed () {
    $('[role="tooltip"]').remove()
  }
}
</script>
