                    <a href="bodyparts">
                      <div class="info-box">
                        <span class="info-box-icon nendo_body_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Body parts</span>
                          <span class="info-box-number">
<?php if( isset($count_userbodyparts) ) { ?>
                            <span class="count_user">
                              <?= $count_userbodyparts; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_bodyparts; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
