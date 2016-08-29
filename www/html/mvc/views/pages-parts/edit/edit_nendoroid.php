        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_nendoroid_box_id" id="new_nendoroid_box_id">
<?php
  if(count($boxes)>1){
?>
                        <option value>- Box -</option>
<?php
  }
?>
<?php
  foreach ($boxes as $box) {
?>
                        <option value="<?= $box['internalid'] ?>"><?= $box['type'] ?> #<?= $box['name']; ?></option>
<?php
  }
?>
                      </select>
                    </div>
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_name" id="new_nendoroid_name" placeholder="Nendoroid name" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_origin" id="new_nendoroid_origin" placeholder="Nendoroid origin" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_version" id="new_nendoroid_version" placeholder="Nendoroid version" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_editor" id="new_nendoroid_editor" placeholder="Nendoroid editor" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="color" name="new_nendoroid_color" id="new_nendoroid_color" placeholder="Nendoroid dominant color" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <ul class="actions">
                      <li>
                        <input type="button" name="new_nendoroid_submit" id="new_nendoroid_submit" value="Add nendoroid" />
                      </li>
                    </ul>
                  </div>
                  <div class="12u">
                    <blockquote class="warning" id="warning_message" style="display:none;"></blockquote>
                  </div>
              </div>
            </div>
          </div>
