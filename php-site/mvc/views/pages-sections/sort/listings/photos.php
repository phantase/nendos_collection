                <!-- Menu button -->
                <div class="1u$ 2u$(small)">
                  <a class="icon fa-sort style2" id="menu_button"></a>
                </div>

              </div>
              <div class="row" id="menu_area" style="display:none;" sortdest="photos">

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
                      <optgroup label="Photo">
                        <option value="photo_title" <?= ($selected_order=="photo_title")?"selected":""; ?>>Title</option>
                        <option value="photo_username" <?= ($selected_order=="photo_username")?"selected":""; ?>>Author</option>
                        <option value="photo_uploaded" <?= ($selected_order=="photo_uploaded")?"selected":""; ?>>Uploaded</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="label">Sort by</div>
                </div>
              </div>
              <div class="row">
              &nbsp;
