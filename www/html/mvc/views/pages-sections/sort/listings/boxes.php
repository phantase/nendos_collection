                <!-- Menu button -->
                <div class="1u$ 2u$(small)">
                  <a class="icon fa-sort style2" id="menu_button"></a>
                </div>

              </div>
              <div class="row" id="menu_area" style="display:none;" sortdest="boxes">

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
                      <optgroup label="Box">
                        <option value="box_number" <?= ($selected_order=="box_number")?"selected":""; ?>>Number</option>
                        <option value="box_name" <?= ($selected_order=="box_name")?"selected":""; ?>>Name</option>
                        <option value="box_category" <?= ($selected_order=="box_category")?"selected":""; ?>>Category</option>
                      </optgroup>
                      <optgroup label="DB">
                        <option value="db_creatorname" <?= ($selected_order=="db_creatorname")?"selected":""; ?>>Creator</option>
                        <option value="db_creationdate" <?= ($selected_order=="db_creationdate")?"selected":""; ?>>Creation date</option>
                        <option value="db_editorname" <?= ($selected_order=="db_editorname")?"selected":""; ?>>Last editor</option>
                        <option value="db_editiondate" <?= ($selected_order=="db_editiondate")?"selected":""; ?>>Last edition date</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="label">Sort by</div>
                </div>
