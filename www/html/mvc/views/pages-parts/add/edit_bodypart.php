        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_bodypart_box_id" id="new_bodypart_box_id" class="select_box_id">
<?php
  if(count($boxes)>1){
?>
                        <option value="0" class="box">- Box -</option>
<?php
  }
?>
<?php
  foreach ($boxes as $box) {
?>
                        <option value="<?= $box['internalid'] ?>" class="box"><?= $box['type'] ?> #<?= $box['name']; ?></option>
<?php
  }
?>
                      </select>
                    </div>
                  </div>
                  <div class="4u$ 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_bodypart_nendoroid_id" id="new_bodypart_nendoroid_id" class="select_nendoroid_id">
<?php
  if( ! isset($_GET['nendoroid_id']) ){
?>
                        <option value="0" class="nendoroid">- Nendoroid -</option>
<?php
  }
?>
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                        <option value="<?= $nendoroid['internalid'] ?>" box="<?= $nendoroid['box_id'] ?>" class="nendoroid"><?= $nendoroid['name'] ?><?php if(strlen($nendoroid['version'])>0){ ?> - <?= $nendoroid['version']; ?><?php } ?></option>
<?php
  }
?>
                      </select>
                    </div>
                  </div>
                  <div class="3u 8u(medium)">
                    <input type="text" name="new_bodypart_main_color" id="new_bodypart_main_color" placeholder="Main color" disabled/>
                  </div>
                  <div class="3u 4u$(medium)">
                    <input type="color" name="new_bodypart_main_color_hex" id="new_bodypart_main_color_hex" placeholder="Main color code" class="color_to_name" />
                  </div>
                  <div class="3u 8u(medium)">
                    <input type="text" name="new_bodypart_second_color" id="new_bodypart_second_color" placeholder="Other color" disabled/>
                  </div>
                  <div class="3u$ 4u$(medium)">
                    <input type="color" name="new_bodypart_second_color_hex" id="new_bodypart_second_color_hex" placeholder="Other color code" class="color_to_name" />
                  </div>
                  <div class="12u$ 12u$(medium)">
                    <input type="text" name="new_bodypart_part" id="new_bodypart_part" placeholder="Part" />
                  </div>
                  <div class="12u$">
                    <input type="text" name="new_bodypart_description" id="new_bodypart_description" placeholder="Description" />
                  </div>
                  <div class="4u$ 12u$(medium)">
                    <ul class="actions">
                      <li>
                        <input type="button" name="new_bodypart_submit" id="new_bodypart_submit" value="Add Bodypart" />
                      </li>
                    </ul>
                  </div>
                  <div class="12u$">
                    <blockquote class="warning" id="warning_message" style="display:none;"></blockquote>
                  </div>
              </div>
            </div>
          </div>
