<template>
    <div class="col-md-6">
      <div class="box collapsed-box">
        <app-box-header title="Last favorited by"
                        :collapsable="true" :collapsed="true"
                        icon="fa-heart"></app-box-header>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Favorite date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="favuser in favusers">
                  <td><router-link :to="'/user/'+favuser.userid">{{ favuser.username }}</router-link></td>
                  <td>{{ favuser.additiondate }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import AppBoxHeader from './../layouts/BoxHeader'

export default {
  name: 'FavoritedTile',
  props: ['favusers'],
  components: {
    AppBoxHeader
  },
  data () {
    return {
    }
  }
}

</script>

<style scoped>
</style>
