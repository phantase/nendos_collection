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
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Collection</th>
                  <th>Favorites</th>
                  <th>Roles</th>
                  <th>Sign-up</th>
                  <th>Last view</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users">
                  <td>{{ user.internalid }}</td>
                  <td><router-link :to="'user/' + user.internalid">{{ user.username }}</router-link></td>
                  <td>
                    <span class="element-count">
                      <i class="fa icon-icon_nendo_boxes"></i>
                      <span class="label label-warning">{{ countBoxesInUserCollection(user) }}</span>
                    </span>
                    <span class="element-count">
                      <i class="fa icon-icon_nendo_nendo"></i>
                      <span class="label label-warning">{{ countNendoroidsInUserCollection(user) }}</span>
                    </span>
                  </td>
                  <td></td>
                  <td>
                    <i class="fa fa-gavel" data-toggle="tooltip" title="Administrator" v-if="user.administrator === '1'"></i>
                    <i class="fa fa-check-square-o" data-toggle="tooltip" title="Validator" v-if="user.validator === '1'"></i>
                    <i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Editor" v-if="user.editor === '1'"></i>
                    <i class="fa fa-user-circle-o" data-toggle="tooltip" title="User"></i>
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

export default {
  name: 'Photos',
  components: {
    AppBoxHeader
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
    ...Vuex.mapGetters(['users', 'boxes', 'nendoroids']),
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
    }
  }
}
</script>

<style>
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
</style>
