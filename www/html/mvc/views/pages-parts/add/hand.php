        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_hand_box_internalid" id="new_hand_box_internalid" class="select_box_internalid">
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
                      <select name="new_hand_nendoroid_internalid" id="new_hand_nendoroid_internalid" class="select_nendoroid_internalid">
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
                  <div class="4u 12u$(small)">
                    <input type="text" name="new_hand_posture" id="new_hand_posture" placeholder="Posture" />
                  </div>
                  <div class="4u 12u$(small)">
                    <div class="select-wrapper">
                      <select name="new_hand_leftright" id="new_hand_leftright">
                        <option value="Left" class="leftright">Left</option>
                        <option value="Right" class="leftright">Right</option>
                        <option value="Both" class="leftright">Both</option>
                      </select>
                    </div>
                  </div>
                  <div class="4u$ 12u$(small)">
                    <input type="text" name="new_hand_skin_color" id="new_hand_skin_color" placeholder="Skin color"/>
                  </div>
                  <div class="8u 12u$(small)">
                    <input type="text" name="new_hand_description" id="new_hand_description" placeholder="Description" />
                  </div>
                  <div class="4u 12u$(small)">
                    <ul class="actions">
                      <li>
                        <input type="button" name="new_hand_submit" id="new_hand_submit" value="Add hand" />
                      </li>
                    </ul>
                  </div>
                  <div class="12u$">
                    <blockquote class="warning" id="warning_message" style="display:none;"></blockquote>
                  </div>
              </div>
            </div>
          </div>
