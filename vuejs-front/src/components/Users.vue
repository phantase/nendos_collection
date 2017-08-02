<template>
  <div class="db-users">
    <div class="row">
      <div class="col-md-12">
        <div class="box collapsed-box">
          <app-box-header title="Sorting and filtering" collapsable="true" collapsed="true" icon="fa-filter"></app-box-header>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <div class="pull-right">
                  <label>Sort by: </label>
                  <select v-model="orderedby">
                    <optgroup label="User">
                      <option value="username">Name</option>
                      <option value="signupdate">Sign up</option>
                      <option value="lastviewdate">Last view</option>
                    </optgroup>
                  </select>
                  <select v-model="direction">
                    <option value="asc">Asc</option>
                    <option value="desc">Desc</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Users</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table">
              <thead>
                <tr>
                  <th><i class="fa fa-hashtag"></i></th>
                  <th><i class="fa fa-id-card-o"></i> Name</th>
                  <th><i class="fa fa-cubes"></i> Collection</th>
                  <th><i class="fa fa-heart"></i> Favorites</th>
                  <th><i class="fa fa-tags"></i> Roles</th>
                  <th><i class="fa fa-sign-in"></i> Sign-up</th>
                  <th><i class="fa fa-eye"></i> Last view</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users">
                  <td>{{ user.internalid }}</td>
                  <td>
                    <router-link :to="'user/' + user.internalid">{{ user.username }}</router-link>
                    <div class="image limitedsize">
                      <img :src="resources.img_url+'/images/users/'+user.internalid+'/thumb'" v-if="user.haspicture == '1'" :alt="user.username" class="img-circle" />
                      <img :src="resources.img_url+'/images/unknown'" v-else :alt="user.username" class="img-circle" />
                    </div>
                  </td>
                  <td>
                    <table class="table table-collandfav">
                      <progress-table-row icon="icon-icon_nendo_boxes" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countBoxesInUserCollection(user)" :total="boxes.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_nendo" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countNendoroidsInUserCollection(user)" :total="nendoroids.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_face" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countFacesInUserCollection(user)" :total="faces.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_hair" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countHairsInUserCollection(user)" :total="hairs.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_hand" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countHandsInUserCollection(user)" :total="hands.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_body" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countBodypartsInUserCollection(user)" :total="bodyparts.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_accessories" bartype="progress-bar-warning" badgecolor="bg-orange"
                                          :value="countAccessoriesInUserCollection(user)" :total="accessories.length"></progress-table-row>
                    </table>
                  </td>
                  <td>
                    <table class="table table-collandfav">
                      <progress-table-row icon="icon-icon_nendo_boxes" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countBoxesInUserFavorites(user)" :total="boxes.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_nendo" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countNendoroidsInUserFavorites(user)" :total="nendoroids.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_face" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countFacesInUserFavorites(user)" :total="faces.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_hair" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countHairsInUserFavorites(user)" :total="hairs.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_hand" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countHandsInUserFavorites(user)" :total="hands.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_body" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countBodypartsInUserFavorites(user)" :total="bodyparts.length"></progress-table-row>
                      <progress-table-row icon="icon-icon_nendo_accessories" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countAccessoriesInUserFavorites(user)" :total="accessories.length"></progress-table-row>
                      <progress-table-row icon="fa-image" bartype="progress-bar-danger" badgecolor="bg-red"
                                          :value="countPhotosInUserFavorites(user)" :total="accessories.length"></progress-table-row>
                    </table>
                  </td>
                  <td>
                    <p v-if="user.administrator === '1'"><i class="fa fa-gavel" data-toggle="tooltip" title="Administrator" v-if="user.administrator === '1'"></i> Administrator</p>
                    <p v-if="user.validator === '1'"><i class="fa fa-check-square-o" data-toggle="tooltip" title="Validator" v-if="user.validator === '1'"></i> Validator</p>
                    <p v-if="user.editor === '1'"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Editor" v-if="user.editor === '1'"></i> Editor</p>
                    <p><i class="fa fa-user-circle-o" data-toggle="tooltip" title="User"></i> User</p>
                  </td>
                  <td>{{ user.signupdate }}</td>
                  <td>{{ user.lastviewdate }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import store from './../store'
import Vuex from 'vuex'

import Resources from './../config/resources'

import AppBoxHeader from './layouts/BoxHeader'
import ProgressTableRow from './dblayouts/ProgressTableRow'

export default {
  name: 'Users',
  components: {
    AppBoxHeader,
    ProgressTableRow
  },
  store: store,
  data () {
    return {
      resources: Resources,
      orderedby: 'username',
      direction: 'desc'
    }
  },
  computed: {
    ...Vuex.mapGetters(['users', 'boxes', 'nendoroids', 'faces', 'hairs', 'hands', 'bodyparts', 'accessories', 'photos']),
    displayedUsers () {
      return this.users.concat().sort(this.sortUsers)
    }
  },
  methods: {
    sortUsers (a, b) {
      if (a[this.orderedby] > b[this.orderedby]) {
        return this.direction === 'desc' ? -1 : 1
      } else {
        return this.direction === 'desc' ? 1 : -1
      }
    },
    countBoxesInUserCollection (user) {
      return this.boxes.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countNendoroidsInUserCollection (user) {
      return this.nendoroids.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countFacesInUserCollection (user) {
      return this.faces.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countHairsInUserCollection (user) {
      return this.hairs.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countHandsInUserCollection (user) {
      return this.hands.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countBodypartsInUserCollection (user) {
      return this.bodyparts.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countAccessoriesInUserCollection (user) {
      return this.accessories.filter(elem => elem.colusers && elem.colusers.findIndex(coluser => coluser.userid === user.internalid) !== -1).length
    },
    countBoxesInUserFavorites (user) {
      return this.boxes.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countNendoroidsInUserFavorites (user) {
      return this.nendoroids.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countFacesInUserFavorites (user) {
      return this.faces.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countHairsInUserFavorites (user) {
      return this.hairs.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countHandsInUserFavorites (user) {
      return this.hands.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countBodypartsInUserFavorites (user) {
      return this.bodyparts.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countAccessoriesInUserFavorites (user) {
      return this.accessories.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    },
    countPhotosInUserFavorites (user) {
      return this.photos.filter(elem => elem.favusers && elem.favusers.findIndex(favuser => favuser.userid === user.internalid) !== -1).length
    }
  }
}
</script>

<style scoped>
  .element-count {
    position: relative;
  }

  .element-count>.label {
    position: absolute;
    top: -5px;
    left: 7px;
    text-align: center;
    font-size: 9px;
    padding: 2px 3px;
    line-height: .9;
  }

  .table-collandfav {
    width: 100%;
  }

  .limitedsize > img {
    width: 100%;
    max-width: 45px;
    height: 100%;
  }
</style>
