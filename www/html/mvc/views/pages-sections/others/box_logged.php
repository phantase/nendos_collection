                      <div class="info-box">
                        <span class="info-box-icon login_icon"></span>
                        <div class="info-box-content">
                          <div class="info-box-text" id="username_holder">
                            <a href="user/<?= $_SESSION['userid'] ?>/">
                              <?= $_SESSION['username'];?>
                            </a>
                            <a id="logout_submit">(Log out)</a>
                            <span style="float:right;">
<?php if( isAdministrator() ) { ?>
                              <i class="icon fa-cogs" title="Administrator"></i>
<?php } ?>
<?php if( isValidator() ) { ?>
                              <i class="icon fa-check-square-o" title="Validator"></i>
<?php } ?>
<?php if( isEditor() ) { ?>
                              <i class="icon fa-pencil-square-o" title="Editor"></i>
<?php } ?>
                              <i class="icon fa-user" title="User"></i>
                            </span>
                          </div>
                        </div>
                      </div>
