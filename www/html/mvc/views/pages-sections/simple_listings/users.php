                  <div class="row">
                    <div class="12u$">
                      <div class="table-wrapper">
                        <table>
                          <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Mail</th>
                            <th>Rights</th>
                            <th>Joined date</th>
                            <th>Last view on</th>
                          </tr>
<?php
  foreach ($users as $user) {
?>
                          <tr>
                            <td><?= $user['internalid'] ?></td>
                            <td>
<?php if($withlinks){ ?>
                              <a href="user/<?= $user['internalid'] ?>/">
<?php } ?>
                                <?= $user['username'] ?>
<?php if($withlinks){ ?>
                              </a>
<?php } ?>
                            </td>
                            <td>
                              <?= $user['usermail'] ?>
                            </td>
                            <td>
<?php if( $user['administrator'] ) { ?>
                              <i class="icon fa-cogs" title="Administrator"></i>
<?php } ?>
<?php if( $user['validator'] ) { ?>
                              <i class="icon fa-check-square-o" title="Validator"></i>
<?php } ?>
<?php if( $user['editor'] ) { ?>
                              <i class="icon fa-pencil-square-o" title="Editor"></i>
<?php } ?>
                            </td>
                            <td>
                              <?= $user['signupdate'] ?>
                            </td>
                            <td>
                              <?= $user['lastviewdate'] ?>
                            </td>
                          </tr>
<?php
  }
?>
                        </table>
                      </div>
                    </div>
                  </div>
