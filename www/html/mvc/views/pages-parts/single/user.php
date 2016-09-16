        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u$">
                  <div class="table-wrapper">
                    <table id="info_table" element="user" internalid="<?= $user['internalid'] ?>">
                      <tbody>
                        <tr>
                          <th>ID</th>
                          <td>
                            <?= $user['internalid'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Username</th>
                          <td>
                            <?= $user['username'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Mail</th>
                          <td>
                            <?= $user['usermail'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>
                            Rights
<?php if( $_SESSION['administrator'] ) { ?>
                            <a class="edit" id="edit_user_rights"><span>Edit</span><span style="display:none;">Hide</span></a>
<?php } ?>
                          </th>
                          <td>
                            <div id="user_rights_noedit">
                              <i id="administrator_view" class="icon fa-cogs" title="Administrator" <?php if( ! $user['administrator'] ) { ?>style="display:none;"<?php } ?>></i>
                              <i id="validator_view"     class="icon fa-check-square-o" title="Validator" <?php if( ! $user['validator'] ) { ?>style="display:none;"<?php } ?>></i>
                              <i id="editor_view"        class="icon fa-pencil-square-o" title="Editor" <?php if( ! $user['editor'] ) { ?>style="display:none;"<?php } ?>></i>
                              <i id="user_view"          class="icon fa-user" title="User"></i>
                            </div>
                            <div id="user_rights_edit" style="display:none;" class="uniform">
                              <input type="checkbox" name="administrator" id="administrator" <?php if($user['administrator']){ ?>checked<?php } ?> />
                              <label for="administrator">Administrator</label>
                              <input type="checkbox" name="validator"     id="validator"     <?php if($user['validator']){     ?>checked<?php } ?> />
                              <label for="validator">Validator</label>
                              <input type="checkbox" name="editor"        id="editor"        <?php if($user['editor']){        ?>checked<?php } ?> />
                              <label for="editor">Editor</label>
                              <input type="checkbox" name="user"          id="user"          disabled checked />
                              <label for="user">User</label>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th>Sign up on</th>
                          <td>
                            <?= $user['signupdate'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Last view on</th>
                          <td>
                            <?= $user['lastviewdate'] ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
