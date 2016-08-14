        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
                  <div class="6u">
                    &nbsp;
                  </div>
                  <div class="3u">
                  <?php showBoxesCount($count_boxes); ?>
                  </div>
                  <div class="3u">
                    <a href="nendoroids">
                      <div class="info-box">
                        <span class="info-box-icon nendo_nendo_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Nendoroids</span>
                          <span class="info-box-number"><?= $count_nendoroids; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="row">
                  <div class="2u">
                    <a href="faces">
                      <div class="info-box">
                        <span class="info-box-icon nendo_face_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Faces</span>
                          <span class="info-box-number"><?= $count_faces; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="2u">
                    <a href="hairs">
                      <div class="info-box">
                        <span class="info-box-icon nendo_hair_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Hairs</span>
                          <span class="info-box-number"><?= $count_hairs; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="2u">
                    <a href="hands">
                      <div class="info-box">
                        <span class="info-box-icon nendo_hand_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Hands</span>
                          <span class="info-box-number"><?= $count_hands; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="3u">
                    <a href="bodyparts">
                      <div class="info-box">
                        <span class="info-box-icon nendo_body_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Body parts</span>
                          <span class="info-box-number"><?= $count_body_parts; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="3u">
                    <a href="accessories">
                      <div class="info-box">
                        <span class="info-box-icon nendo_accessories_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Accessories</span>
                          <span class="info-box-number"><?= $count_accessories; ?></span>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </header>
              <p/>
<?php showNendoroidsListing($nendoroids, "home",null); ?>
              <div class="pager">
                <ul class="pagination"></ul>
              </div>

            </div>
          </div>
