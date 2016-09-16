                  <div class="row">
<?php
  foreach ($users as $user) {
?>
                    <div class="3u 6u(medium) 12u(small)">
                      <div class="user">
                        <div>
                          <span class="userid">
                            <?= $user['internalid'] ?>
                          </span>
                          <span class="username">
  <?php if($withlinks){ ?>
                            <a href="user/<?= $user['internalid'] ?>/">
  <?php } ?>
                              <?= $user['username'] ?>
  <?php if($withlinks){ ?>
                            </a>
  <?php } ?>
                          </span>
                          <span class="righticons">
  <?php if( $user['administrator'] ) { ?>
                            <i class="icon fa-cogs" title="Administrator"></i>
  <?php } ?>
  <?php if( $user['validator'] ) { ?>
                            <i class="icon fa-check-square-o" title="Validator"></i>
  <?php } ?>
  <?php if( $user['editor'] ) { ?>
                            <i class="icon fa-pencil-square-o" title="Editor"></i>
  <?php } ?>
                            <i class="icon fa-user" title="User"></i>
                          </span>
                        </div>
                        <div>
                          <?= $user['usermail'] ?>
                        </div>
                        <div>
                          Sign up: <i><?= $user['signupdate'] ?></i>
                        </div>
                        <div>
                          Last on: <i><?= $user['lastviewdate'] ?></i>
                        </div>
                      </div>
                    </div>
<?php
  }
?>
                  </div>
