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
                  <div class="3u 4u(medium) 6u(small)"><?php showNendoroidsCounter($count_nendoroids,$count_usernendoroids); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showFacesCounter($count_faces,$count_userfaces); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showHairsCounter($count_hairs,$count_userhairs); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showHandsCounter($count_hands,$count_userhands); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showBodyPartsCounter($count_bodyparts,$count_userbodyparts); ?></div>
                  <div class="3u 4u(medium) 6u(small)"><?php showAccessoriesCounter($count_accessories,$count_useraccessories); ?></div>
                </div>
              </header>
              <p/>
<?php showNendoroidsArticle($nendoroids); ?>

            </div>
          </div>
