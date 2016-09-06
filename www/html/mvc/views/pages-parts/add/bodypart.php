        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_bodypart_box_internalid" id="new_bodypart_box_internalid" class="select_box_internalid">
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
                        <option value="<?= $box['box_internalid'] ?>" class="box">
                          <?= $box['box_category'] ?>
                          <?php if(isset($box['box_number']) && strlen($box['box_number'])>0){ ?> #<?= $box['box_number']; ?><?php } ?>
                           - <?= $box['box_name'] ?>
                        </option>
<?php
  }
?>
                      </select>
                    </div>
                  </div>
                  <div class="4u$ 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_bodypart_nendoroid_internalid" id="new_bodypart_nendoroid_internalid" class="select_nendoroid_internalid">
<?php
  if( ! isset($_GET['nendoroid_internalid']) ){
?>
                        <option value="0" class="nendoroid">- Nendoroid -</option>
<?php
  }
?>
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                        <option value="<?= $nendoroid['nendoroid_internalid'] ?>" box="<?= $nendoroid['box_internalid'] ?>" class="nendoroid">
                          <?= $nendoroid['nendoroid_name'] ?>
                          <?php if(strlen($nendoroid['nendoroid_version'])>0){ ?> - <?= $nendoroid['nendoroid_version']; ?><?php } ?>
                        </option>
<?php
  }
?>
                      </select>
                    </div>
                  </div>
                  <div class="12u$ 12u$(medium)">
                    <input type="text" name="new_bodypart_part" id="new_bodypart_part" placeholder="Part" />
                  </div>
                  <div class="6u 12u$(small)">
                    <input type="text" name="new_bodypart_main_color" id="new_bodypart_main_color" placeholder="Main color" />
                  </div>
                  <div class="6u 12u$(small)">
                    <input type="text" name="new_bodypart_other_color" id="new_bodypart_other_color" placeholder="Other color" />
                  </div>
                  <div class="8u 12u$(small)">
                    <input type="text" name="new_bodypart_description" id="new_bodypart_description" placeholder="Description" />
                  </div>
                  <div class="4u$ 12u$(small)">
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
