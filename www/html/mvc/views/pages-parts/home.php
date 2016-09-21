        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
<?php if( ! isLogged() ) { ?>
                  <div class="3u 8u(medium) 6u(small)">
                    <?php
                      include('mvc/views/pages-sections/others/box_login.php');
                    ?>
                  </div>
<?php } else { ?>
                  <div class="3u 8u(medium) 6u(small)">
                    <?php
                      include('mvc/views/pages-sections/others/box_logged.php');
                    ?>
                  </div>
<?php } // End isLogged ?>
                  <div class="3u 4u(medium) 6u(small)"><?php showBoxesCounter($count_boxes,$count_userboxes); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showNendoroidsCounter($count_nendoroids); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showFacesCounter($count_faces); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showHairsCounter($count_hairs); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showHandsCounter($count_hands); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showBodyPartsCounter($count_bodyparts); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showAccessoriesCounter($count_accessories); ?></div>
                </div>
              </header>
              <p/>
<?php showNendoroidsArticle($nendoroids); ?>

            </div>
          </div>
