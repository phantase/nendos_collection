                <!-- Menu button -->
                <div class="1u$ 2u$(small)">
                  <a class="icon fa-sort style2" id="menu_button"></a>
                </div>

              </div>
              <div class="row" id="menu_area" style="display:none;" sortdest="bodyparts">

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
                      <optgroup label="Body Part">
                        <option value="bodypart_part" <?= ($selected_order=="bodypart_part")?"selected":""; ?>>Part</option>
                        <option value="bodypart_main_color" <?= ($selected_order=="bodypart_main_color")?"selected":""; ?>>Main color</option>
                        <option value="bodypart_other_color" <?= ($selected_order=="bodypart_other_color")?"selected":""; ?>>Other color</option>
                      </optgroup>
                      <optgroup label="Nendoroid">
                        <option value="nendoroid_name" <?= ($selected_order=="nendoroid_name")?"selected":""; ?>>Name</option>
                        <option value="nendoroid_version" <?= ($selected_order=="nendoroid_version")?"selected":""; ?>>Version</option>
                        <option value="nendoroid_sex" <?= ($selected_order=="nendoroid_sex")?"selected":""; ?>>Sex</option>
                      </optgroup>
                      <optgroup label="Box">
                        <option value="box_number" <?= ($selected_order=="box_number")?"selected":""; ?>>Number</option>
                        <option value="box_name" <?= ($selected_order=="box_name")?"selected":""; ?>>Name</option>
                        <option value="box_series" <?= ($selected_order=="box_series")?"selected":""; ?>>Series</option>
                        <option value="box_manufacturer" <?= ($selected_order=="box_manufacturer")?"selected":""; ?>>Manufacturer</option>
                        <option value="box_category" <?= ($selected_order=="box_category")?"selected":""; ?>>Category</option>
                        <option value="box_price" <?= ($selected_order=="box_price")?"selected":""; ?>>Price</option>
                        <option value="box_releasedate" <?= ($selected_order=="box_releasedate")?"selected":""; ?>>Release date</option>
                        <option value="box_sculptor" <?= ($selected_order=="box_sculptor")?"selected":""; ?>>Sculptor</option>
                        <option value="box_cooperation" <?= ($selected_order=="box_cooperation")?"selected":""; ?>>Cooperation</option>
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
              </div>
              <div class="row">
              &nbsp;
