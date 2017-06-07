<template>
    <div class="col-md-6">
      <div class="box collapsed-box">
        <app-box-header title="Last collected by"
                        :collapsable="true" :collapsed="true"
                        icon="fa-cubes"></app-box-header>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Collection date</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="coluser in colusers">
                  <td><router-link :to="'/user/'+coluser.userid">{{ coluser.username }}</router-link></td>
                  <td>{{ coluser.additiondate }}</td>
                  <td>{{ coluser.quantity }} </td>
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
  props: ['colusers'],
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
