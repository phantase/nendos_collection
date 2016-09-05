        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_face_box_internalid" id="new_face_box_internalid" class="select_box_internalid">
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
                      <select name="new_face_nendoroid_internalid" id="new_face_nendoroid_internalid" class="select_nendoroid_internalid">
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
                  <div class="8u 12u$(small)">
                    <input type="text" name="new_face_eyes" id="new_face_eyes" placeholder="Eyes" />
                  </div>
                  <div class="4u$ 12u$(small)">
                    <input type="text" name="new_face_eyes_color" id="new_face_eyes_color" placeholder="Eyes color name" />
                  </div>
                  <div class="8u 12u$(small)">
                    <input type="text" name="new_face_mouth" id="new_face_mouth" placeholder="Mouth" />
                  </div>
                  <div class="4u 12u$(small)">
                    <input type="text" name="new_face_skin_color" id="new_face_skin_color" placeholder="Skin color name" />
                  </div>
                  <div class="4u 12u$(small)">
                    <div class="select-wrapper">
                      <select name="new_face_sex" id="new_face_sex">
                        <option value="Undefined" class="sex">- Sex -</option>
                        <option value="Female" class="sex">Female</option>
                        <option value="Male" class="sex">Male</option>
                      </select>
                    </div>
                  </div>
                  <div class="4u$ 12u$(small)">
                    <ul class="actions">
                      <li>
                        <input type="button" name="new_face_submit" id="new_face_submit" value="Add Face" />
                      </li>
                    </ul>
                  </div>
                  <div class="12u">
                    <blockquote class="warning" id="warning_message" style="display:none;"></blockquote>
                  </div>
              </div>
            </div>
          </div>
