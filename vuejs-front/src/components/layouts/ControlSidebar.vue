<template>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Loading status</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_boxes" :class="boxesLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Boxes</h4>
                <p v-if="boxesLoadedDate">{{ boxesLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_nendo" :class="nendoroidsLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nendoroids</h4>
                <p v-if="nendoroidsLoadedDate">{{ nendoroidsLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_face" :class="facesLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Faces</h4>
                <p v-if="facesLoadedDate">{{ facesLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_hair" :class="hairsLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Hairs</h4>
                <p v-if="hairsLoadedDate">{{ hairsLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_hand" :class="handsLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Hands</h4>
                <p v-if="handsLoadedDate">{{ handsLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_body" :class="bodypartsLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Bodyparts</h4>
                <p v-if="bodypartsLoadedDate">{{ bodypartsLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa icon-icon_nendo_accessories" :class="accessoriesLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Accessories</h4>
                <p v-if="accessoriesLoadedDate">{{ accessoriesLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa fa-photo" :class="photosLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Photos</h4>
                <p v-if="photosLoadedDate">{{ photosLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa fa-address-book-o" :class="usersLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Users</h4>
                <p v-if="usersLoadedDate">{{ usersLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript;">
              <i class="menu-icon fa fa-newspaper-o" :class="newsLoadedDate?'bg-green':'bg-red'"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">News</h4>
                <p v-if="newsLoadedDate">{{ newsLoadedDate }}</p>
                <p v-else>Not loaded</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <!--<h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-info bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">No activity</h4>
                <p>Not implemented...</p>
              </div>
            </a>
          </li>
          <li v-if="false">
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>-->
        <!-- /.control-sidebar-menu -->
        <!--<h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li v-if="false">
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                No progress
                <span class="pull-right-container">
                  <span class="label label-warning pull-right">N.I.</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 100%"></div>
              </div>
            </a>
          </li>
          <li v-if="false">
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>-->
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Automatic reload
              <input type="checkbox" class="pull-right" v-model="localAutoReload">
            </label>

            <p>
              The data will be automatically fetched from the database without need for any action from your side
            </p>
          </div>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Reload each
            </label>
            <select class="form-control" v-model="localReloadInterval">
              <option value="1">1 minute</option>
              <option value="2">2 minutes</option>
              <option value="5">5 minutes</option>
              <option value="10">10 minutes</option>
              <option value="30">30 minutes</option>
            </select>
          </div>
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
</template>

<script>
  import store from './../../store'
  import Vuex from 'vuex'

  export default {
    name: 'ControlSidebar',
    store: store,
    data () {
      return {
      }
    },
    computed: {
      ...Vuex.mapGetters(['autoReload', 'reloadInterval', 'boxesLoadedDate', 'nendoroidsLoadedDate', 'facesLoadedDate', 'hairsLoadedDate', 'handsLoadedDate', 'bodypartsLoadedDate', 'accessoriesLoadedDate', 'photosLoadedDate', 'usersLoadedDate', 'newsLoadedDate']),
      localAutoReload: {
        get () {
          return this.autoReload
        },
        set (value) {
          this.setAutoReload({'value': value, 'context': this})
        }
      },
      localReloadInterval: {
        get () {
          return this.reloadInterval
        },
        set (value) {
          this.setReloadInterval({'value': value, 'context': this})
        }
      }
    },
    methods: {
      ...Vuex.mapActions(['setAutoReload', 'setReloadInterval'])
    }
  }
</script>
