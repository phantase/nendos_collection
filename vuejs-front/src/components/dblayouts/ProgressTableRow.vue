<template>
  <tr>
    <td><i class="fa" :class="icon"></i></td>
    <td>
      <div class="progress progress-xs">
        <div class="progress-bar" :class="bartype" :style="'width:'+value/total*100+'%'"></div>
      </div>
    </td>
    <td>
      <span class="badge" :class="badgecolor">{{ value }}/{{ total }}</span>
    </td>
  </tr>
</template>

<script>

export default {
  name: 'BoxTile',
  props: ['icon', 'bartype', 'badgecolor', 'value', 'total'],
  data () {
    return {
    }
  }
}

</script>

<style scoped>
  tr > td:first-child {
    width: 16px;
  }
  tr > td:last-child {
    width: 50px;
    padding-left: 3px;
  }
  tr > td:last-child > span {
    width: 100%;
  }
</style>
