                    <a href="boxes">
                      <div class="info-box">
                        <span class="info-box-icon nendo_boxes_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Boxes</span>
                          <span class="info-box-number">
<?php if( isset($count_userboxes) ) { ?>
                            <span class="count_user">
                              <?= $count_userboxes; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_boxes; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
