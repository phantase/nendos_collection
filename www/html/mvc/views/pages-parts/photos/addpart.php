        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u$">
                  <div class="table-wrapper">
                    <table id="info_table" element="photo" internalid="<?= $user['internalid'] ?>">
                      <tbody>
                        <tr>
                          <th>Photo title</th>
                          <td colspan="5">
                            <?= $photo['photo_title'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>From box</th>
                          <td colspan="5">
                            <div class="ui-widget">
                              <input type="text" id="box_chooser" name="box_chooser" placeholder="Enter the name of the box/nendoroid..." />
                              <div id="box_choosen" style="display:none;"></div>
                              <div id="box_cancel" style="display:none;"><a>Reset box selection</a></div>
                              <input type="hidden" id="box_choosen_id" />
                            </div>
                          </td>
                        </tr>
                        <tr id="parttype_chooser_tr" style="display:none;">
                          <th>Part type</th>
                          <td colspan="5">
                            <div class="ui-widget" id="parttype_chooser">
                              <img src="images/icon_nendo_boxes.png" alt="boxes" title="Box" />
                              <img src="images/icon_nendo_nendo.png" alt="nendoroids" title="Nendoroid" />
                              <img src="images/icon_nendo_face.png" alt="faces" title="Face" />
                              <img src="images/icon_nendo_hair.png" alt="hairs" title="Hair" />
                              <img src="images/icon_nendo_hand.png" alt="hands" title="Hand" />
                              <img src="images/icon_nendo_body.png" alt="bodyparts" title="Bodypart" />
                              <img src="images/icon_nendo_accessories.png" alt="accessories" title="Accessory" />
                            </div>
                          </td>
                        </tr>
                        <tr id="part_chooser_tr" style="display:none;">
                          <th>Part</th>
                          <td colspan="5">
                            <div class="row" id="part_chooser">
                            </div>
                          </td>
                        </tr>
                        <tr style="display:none;">
                          <th></th>
                          <td>
                            <div class="select-wrapper">
                              <select id="category" name="category">
                                <optgroup label="Category">
                                  <option name="Box">Box</option>
                                  <option name="Nendoroid">Nendoroid</option>
                                  <option name="Accessory">Accessory</option>
                                  <option name="Bodypart">Bodypart</option>
                                  <option name="Face">Face</option>
                                  <option name="Hair">Hair</option>
                                  <option name="Hand">Hand</option>
                                </optgroup>
                              </select>
                            </div>
                          </td>
                          <td>
                            <div class="select-wrapper">
                              <select id="part" name="part">
                                <optgroup label="Box" id="part_box">
<?php foreach ($boxes as $box) { ?>
                                  <option name="<?= $box['box_internalid'] ?>">
                                    <?= $box['box_category'] ?>
<?php if($box['box_number']){ ?>
                                    #<?= $box['box_number'] ?>
<?php } ?>
                                    - <?= $box['box_name'] ?>
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Nendoroid" id="part_nendoroid" style="display:none;">
<?php foreach ($nendoroids as $nendoroid) { ?>
                                  <option name="<?= $nendoroid['nendoroid_internalid'] ?>">
                                    <?= $nendoroid['nendoroid_name'] ?>
<?php if($nendoroid['nendoroid_version']){ ?>
                                    ~ <?= $nendoroid['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $nendoroid['box_category'] ?>
<?php if($nendoroid['box_number']){ ?>
                                    #<?= $nendoroid['box_number'] ?>
<?php } ?>
                                    - <?= $nendoroid['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Accessory" id="part_accessory" style="display:none;">
<?php foreach ($accessories as $accessory) { ?>
                                  <option name="<?= $accessory['accessory_internalid'] ?>">
                                    <?= $accessory['accessory_type'] ?> -
                                    <?= $accessory['nendoroid_name'] ?>
<?php if($accessory['nendoroid_version']){ ?>
                                    ~ <?= $accessory['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $accessory['box_category'] ?>
<?php if($accessory['box_number']){ ?>
                                    #<?= $accessory['box_number'] ?>
<?php } ?>
                                    - <?= $accessory['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Bodypart" id="part_bodypart" style="display:none;">
<?php foreach ($bodyparts as $bodypart) { ?>
                                  <option name="<?= $bodypart['bodypart_internalid'] ?>">
                                    <?= $bodypart['bodypart_part'] ?> -
                                    <?= $bodypart['nendoroid_name'] ?>
<?php if($bodypart['nendoroid_version']){ ?>
                                    ~ <?= $bodypart['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $bodypart['box_category'] ?>
<?php if($bodypart['box_number']){ ?>
                                    #<?= $bodypart['box_number'] ?>
<?php } ?>
                                    - <?= $bodypart['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Face" id="part_face" style="display:none;">
<?php foreach ($faces as $face) { ?>
                                  <option name="<?= $face['face_internalid'] ?>">
                                    <?= $face['face_internalid'] ?> -
                                    <?= $face['nendoroid_name'] ?>
<?php if($face['nendoroid_version']){ ?>
                                    ~ <?= $face['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $face['box_category'] ?>
<?php if($face['box_number']){ ?>
                                    #<?= $face['box_number'] ?>
<?php } ?>
                                    - <?= $face['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Hair" id="part_hair" style="display:none;">
<?php foreach ($hairs as $hair) { ?>
                                  <option name="<?= $hair['hair_internalid'] ?>">
                                    <?= $hair['hair_haircut'] ?> (<?= $hair['hair_frontback'] ?>) -
                                    <?= $hair['nendoroid_name'] ?>
<?php if($hair['nendoroid_version']){ ?>
                                    ~ <?= $hair['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $hair['box_category'] ?>
<?php if($hair['box_number']){ ?>
                                    #<?= $hair['box_number'] ?>
<?php } ?>
                                    - <?= $hair['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                                <optgroup label="Hand" id="part_hand" style="display:none;">
<?php foreach ($hands as $hand) { ?>
                                  <option name="<?= $hand['hand_internalid'] ?>">
                                    <?= $hand['hand_posture'] ?> (<?= $hand['hand_leftright'] ?>) -
                                    <?= $hand['nendoroid_name'] ?>
<?php if($hand['nendoroid_version']){ ?>
                                    ~ <?= $hand['nendoroid_version'] ?>
<?php } ?>
                                    [<?= $hand['box_category'] ?>
<?php if($hand['box_number']){ ?>
                                    #<?= $hand['box_number'] ?>
<?php } ?>
                                    - <?= $hand['box_name'] ?>]
                                  </option>
<?php } ?>
                                </optgroup>
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="12u$">
                  <div class="image-and-annotations">
                    <img src="images/nendos/photos/<?= $photo['photo_internalid'] ?>_full"
                         original_width="<?= $photo['photo_width'] ?>" original_height="<?= $photo['photo_height'] ?>"
                         alt="<?= $photo['photo_title'] ?>"
                         class="annotated-image"
                         style="width:10%;" />
                  </div>
                </div>
              </div>
            </div>
          </div>
