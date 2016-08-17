        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
                  <div class="4u">

                    <?php
                    if(!isset($_SESSION['userid'])) {
                      include('mvc/views/pages-sections/others/box_login.php');
                    } else {
                      include('mvc/views/pages-sections/others/box_logged.php');
                    }
                    ?>
                  </div>
                  <div class="2u">
                    &nbsp;
                  </div>
                  <div class="3u"><?php showBoxesCounter($count_boxes); ?></div>
                  <div class="3u"><?php showNendoroidsCounter($count_nendoroids); ?></div>
                </div>
                <div class="row">
                  <div class="2u"><?php showFacesCounter($count_faces); ?></div>
                  <div class="2u"><?php showHairsCounter($count_hairs); ?></div>
                  <div class="2u"><?php showHandsCounter($count_hands); ?></div>
                  <div class="3u"><?php showBodyPartsCounter($count_bodyparts); ?></div>
                  <div class="3u"><?php showAccessoriesCounter($count_accessories); ?></div>
                </div>
              </header>
              <p/>
<?php showNendoroidsListing($nendoroids, "home",null); ?>
              <div class="pager">
                <ul class="pagination"></ul>
              </div>

            </div>
          </div>
