                    <a href="hands">
                      <div class="info-box">
                        <span class="info-box-icon nendo_hand_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Hands</span>
                          <span class="info-box-number">
<?php if( isset($count_userhands) ) { ?>
                            <span class="count_user">
                              <?= $count_userhands; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_hands; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
