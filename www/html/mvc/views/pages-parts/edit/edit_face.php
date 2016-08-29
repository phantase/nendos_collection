        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_face_box_id" id="new_face_box_id" class="select_box_id">
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
                      <select name="new_face_nendoroid_id" id="new_face_nendoroid_id" class="select_nendoroid_id">
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
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_face_eyes" id="new_face_eyes" placeholder="Eyes" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_face_eyes_color" id="new_face_eyes_color" placeholder="Eyes color name" disabled />
                  </div>
                  <div class="4u$ 12u$(medium)">
                    <input type="color" name="new_face_eyes_color_hex" id="new_face_eyes_color_hex" placeholder="Eyes color code" class="color_to_name" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_face_mouth" id="new_face_mouth" placeholder="Mouth" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_face_skin_color" id="new_face_skin_color" placeholder="Skin color name" disabled />
                  </div>
                  <div class="4u$ 12u$(medium)">
                    <input type="color" name="new_face_skin_color_hex" id="new_face_skin_color_hex" placeholder="Skin color code" class="color_to_name" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_face_sex" id="new_face_sex">
                        <option value="undefined" class="sex">- Sex -</option>
                        <option value="female" class="sex">Female</option>
                        <option value="male" class="sex">Male</option>
                      </select>
                    </div>
                  </div>
                  <div class="4u$ 12u$(medium)">
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
