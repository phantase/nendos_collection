        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row uniform">
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_nendoroid_box_internalid" id="new_nendoroid_box_internalid">
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
                        <option value="<?= $box['box_internalid'] ?>">
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
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_name" id="new_nendoroid_name" placeholder="Name" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <input type="text" name="new_nendoroid_version" id="new_nendoroid_version" placeholder="Version" />
                  </div>
                  <div class="4u 12u$(medium)">
                    <div class="select-wrapper">
                      <select name="new_nendoroid_sex" id="new_nendoroid_sex">
                        <option value="Undefined">- Sex -</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                      </select>
                    </div>
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
