                <!-- Menu button -->
                <div class="1u$ 2u$(small)">
                  <a class="icon fa-sort style2" id="menu_button"></a>
                </div>

              </div>
              <div class="row" id="menu_area" style="display:none;">

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
                        <option value="name" <?= ($selected_order=="name")?"selected":""; ?>>Name</option>
                        <option value="type" <?= ($selected_order=="type")?"selected":""; ?>>Type</option>
                      </optgroup>
                      <optgroup label="DB">
                        <option value="creator" <?= ($selected_order=="creator")?"selected":""; ?>>Creator</option>
                        <option value="creation" <?= ($selected_order=="creation")?"selected":""; ?>>Creation date</option>
                        <option value="editor" <?= ($selected_order=="editor")?"selected":""; ?>>Last editor</option>
                        <option value="edition" <?= ($selected_order=="edition")?"selected":""; ?>>Last edition date</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="label">Sort by</div>
                </div>
