                    <a href="hairs">
                      <div class="info-box">
                        <span class="info-box-icon nendo_hair_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Hairs</span>
                          <span class="info-box-number">
<?php if( isset($count_userhairs) ) { ?>
                            <span class="count_user">
                              <?= $count_userhairs; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_hairs; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
