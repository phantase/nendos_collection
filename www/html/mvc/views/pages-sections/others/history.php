              <div class="row">
                <div class="12u$">
                  <h4 id="toggle_history"><a>History (<span>show</span><span style="display:none;">hide</span>)</a></h4>
                  <div class="table-wrapper" style="display:none;">
                    <table>
                      <tbody>
<?php foreach ($history as $key => $histentry) { ?>
                        <tr>
                          <th>
                            <!--(<?= $histentry['history_internalid'] ?>)-->
                            <?= $histentry['history_action'] ?>
                          </th>
                          <td>
<?php if($histentry['hand_internalid']) { ?>
                            Hand (
                              <a href="hand/<?= $histentry['hand_internalid'] ?>/" histentry="hands" internalid="<?= $histentry['hand_internalid'] ?>">
                                <?= $histentry['hand_internalid'] ?>
                              </a>
                            )
<?php } else if($histentry['hair_internalid']) { ?>
                            Hair (
                              <a href="hair/<?= $histentry['hair_internalid'] ?>/" histentry="hairs" internalid="<?= $histentry['hair_internalid'] ?>">
                                <?= $histentry['hair_internalid'] ?>
                              </a>
                            )
<?php } else if($histentry['face_internalid']) { ?>
                            Face (
                              <a href="face/<?= $histentry['face_internalid'] ?>/" histentry="faces" internalid="<?= $histentry['face_internalid'] ?>">
                                <?= $histentry['face_internalid'] ?>
                              </a>
                            )
<?php } else if($histentry['bodypart_part']) { ?>
                            Bodypart (
                              <a href="bodypart/<?= $histentry['bodypart_internalid'] ?>/" histentry="bodyparts" internalid="<?= $histentry['bodypart_internalid'] ?>">
                                <?= $histentry['bodypart_internalid'] ?> - <?= $histentry['bodypart_part'] ?>
                              </a>
                            )
<?php } else if($histentry['accessory_type']) { ?>
                            Accessory (
                              <a href="accessory/<?= $histentry['accessory_internalid'] ?>/" histentry="accessories" internalid="<?= $histentry['accessory_internalid'] ?>">
                                <?= $histentry['accessory_internalid'] ?> - <?= $histentry['accessory_type'] ?>
                              </a>
                            )
<?php } else if($histentry['nendoroid_name']) { ?>
                            Nendoroid (
                              <a href="nendoroid/<?= $histentry['nendoroid_internalid'] ?>/<?= $histentry['nendoroid_url'] ?>/" histentry="nendoroids" internalid="<?= $histentry['nendoroid_internalid'] ?>">
                                <?= $histentry['nendoroid_name'] ?>
                                <?php if(isset($histentry['nendoroid_version']) && strlen($histentry['nendoroid_version'])>0){ ?> - <?= $histentry['nendoroid_version'] ?><?php } ?>
                              </a>
                            )
<?php } else { ?>
                            Box (
                              <a href="box/<?= $histentry['box_internalid'] ?>/<?= $histentry['box_url'] ?>/" histentry="boxes" internalid="<?= $histentry['box_internalid'] ?>">
                                <?= $histentry['box_category'] ?>
                                <?php if( isset($histentry['box_number']) && strlen($histentry['box_number'])>0 ){ ?>
                                  #<?= $histentry['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $histentry['box_name'] ?>
                              </a>
                            )
<?php } ?>
                          </td>
                          <td>
                            by <i><?= $histentry['user_name'] ?></i>
                          </td>
                          <td>
                            <?= intervalFormater($histentry['history_actioninterval']) ?>
                          </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
