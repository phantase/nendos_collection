                <!-- Menu button -->
                <div class="1u$ 2u$(small)">
                  <a class="icon fa-sort style2" id="menu_button"></a>
                </div>

              </div>
              <div class="row" id="menu_area" style="display:none;" sortdest="users">

                <!-- Order by -->
                <div class="12u">
                  <div class="select-wrapper">
                    <select name="direction" id="direction">
                      <option value="asc" <?= ($selected_direction=="asc")?"selected":""; ?>>Asc</option>
                      <option value="desc" <?= ($selected_direction=="desc")?"selected":""; ?>>Desc</option>
                    </select>
                  </div>
                  <div class="select-wrapper">
                    <select name="order" id="order">
                      <optgroup label="User">
                        <option value="username" <?= ($selected_order=="username")?"selected":""; ?>>Username</option>
                        <option value="usermail" <?= ($selected_order=="usermail")?"selected":""; ?>>Mail</option>
                        <option value="administrator" <?= ($selected_order=="administrator")?"selected":""; ?>>Administrator</option>
                        <option value="validator" <?= ($selected_order=="validator")?"selected":""; ?>>Validator</option>
                        <option value="editor" <?= ($selected_order=="editor")?"selected":""; ?>>Editor</option>
                        <option value="signupdate" <?= ($selected_order=="signupdate")?"selected":""; ?>>Sign up date</option>
                        <option value="lastviewdate" <?= ($selected_order=="lastviewdate")?"selected":""; ?>>Last view on</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="label">Sort by</div>
                </div>
              </div>
              <div class="row">
              &nbsp;
