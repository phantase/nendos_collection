                    <a href="faces">
                      <div class="info-box">
                        <span class="info-box-icon nendo_face_icon"></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Faces</span>
                          <span class="info-box-number">
<?php if( isset($count_userfaces) ) { ?>
                            <span class="count_user">
                              <?= $count_userfaces; ?>
                            </span> /
<?php } ?>
                            <span class="count_global">
                              <?= $count_faces; ?>
                            </span>
                          </span>
                        </div>
                      </div>
                    </a>
