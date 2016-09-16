        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
<?php if( ! isLogged() ) { ?>
                  <div class="6u 12u$(medium)">
                    <?php
                      include('mvc/views/pages-sections/others/box_login.php');
                    ?>
                  </div>
<?php } else { ?>
<?php if( isEditor() ) { ?>
                  <div class="4u 8u(medium)">
<?php } else { ?>
                  <div class="6u 8u(medium)">
<?php } ?>
                    <?php
                      include('mvc/views/pages-sections/others/box_logged.php');
                    ?>
                  </div>
<?php if( isEditor() ) { ?>
                  <div class="2u 4u$(medium)">
                    <a href="addbox">
                      <div class="info-box add-box nendo_boxes_icon" id="button_new_box">
                        <i class="icon fa-plus"></i>
                      </div>
                    </a>
                  </div>
<?php } // End isEditor ?>
<?php } // End isLogged ?>
                  <div class="3u 6u(medium)"><?php showBoxesCounter($count_boxes); ?></div>
                  <div class="3u 6u(medium)"><?php showNendoroidsCounter($count_nendoroids); ?></div>
                </div>
                <div class="row">
                  <div class="2u 6u(medium)"><?php showFacesCounter($count_faces); ?></div>
                  <div class="2u 6u(medium)"><?php showHairsCounter($count_hairs); ?></div>
                  <div class="2u 6u(medium)"><?php showHandsCounter($count_hands); ?></div>
                  <div class="3u 6u(medium)"><?php showBodyPartsCounter($count_bodyparts); ?></div>
                  <div class="3u 6u(medium)"><?php showAccessoriesCounter($count_accessories); ?></div>
                </div>
              </header>
              <p/>
<?php showNendoroidsArticle($nendoroids); ?>
              <div class="pager">
                <ul class="pagination"></ul>
              </div>

            </div>
          </div>
