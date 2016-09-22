                    <a href="nendoroids">
                      <div class="info-box">
                        <span class="info-box-icon nendo_nendo_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Nendoroids</span>
                          <span class="info-box-number">
<?php if( isset($count_usernendoroids) ) { ?>
                            <span class="count_user">
                              <?= $count_usernendoroids; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_nendoroids; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
