        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
                  <div class="6u">
                    &nbsp;
                  </div>
                  <div class="3u">
                    <a href="boxes">
                      <div class="info-box">
                        <span class="info-box-icon nendo_boxes_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Boxes</span>
                          <span class="info-box-number"><?= $count_boxes; ?></span>
                        </div>
                      </div>
                    </a>
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
              <section class="tiles">
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                <style>
                  .tiles article#nendo_<?= $nendoroid['internalid'] ?> > .image:before {
                    background-color: #<?= $nendoroid['dominant_color'] ?>;
                  }
                </style>
                <article id="nendo_<?= $nendoroid['internalid'] ?>">
                  <span class="image">
                    <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="nendoroid/<?= $nendoroid['box_name'] ?>/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
                    <h2>#<?= $nendoroid['box_name'] ?><br/><?= $nendoroid['name'] ?></h2>
                    <div class="content">
                      <p><?= $nendoroid['origin'] ?> - <?= $nendoroid['name'] ?> - <?= $nendoroid['box_type'] ?> #<?= $nendoroid['box_name'] ?> - <?= $nendoroid['version'] ?> (<?= $nendoroid['editor'] ?>)</p>
                    </div>
                  </a>
                </article>
<?php
  }
?>
              </section>

              <div class="pager">
                <ul class="pagination"></ul>
              </div>

            </div>
          </div>
