                      <div class="info-box">
                        <span class="info-box-icon login_icon"></span>
                        <div class="info-box-content">
                          <div class="info-box-text" id="username_holder">
                            <a href="user/<?= $_SESSION['userid'] ?>/">
                              <?= $_SESSION['username'];?>
                            </a><br/>
                            <a id="logout_submit">(Log out)</a>
                          </div>
                        </div>
                      </div>
