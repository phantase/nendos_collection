        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_hand<?= $hand['hand_internalid'] ?>">
                    <img src="images/nendos/hands/<?= $hand['hand_internalid'] ?>.jpg" alt="" />
                    <?php if( isEditor() && ! $hand['db_validatorid'] ){ ?>
                      <i class="icon style2 fa-edit included editpic"
                        id="editpic_hand<?= $hand['hand_internalid'] ?>"
                        title="Add/Change the picture"
                        part="hand"
                        internalid="<?= $hand['hand_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit"
                            id="drop_hand<?= $hand['hand_internalid'] ?>"
                            style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="hand" internalid="<?= $hand['hand_internalid'] ?>">
                        <tbody>
<?php
  tableFieldValidate($hand['db_validatorid']);
  tableFieldOwned($hand['coll_additiondate'],$hand['coll_additionsince']);
?>
                          <tr>
                            <th>Box</th>
                            <td>
                              <a href="box/<?= $hand['box_internalid'] ?>/<?= $hand['box_url'] ?>/">
                                <?= $hand['box_category'] ?>
                                <?php if( isset($hand['box_number']) && strlen($hand['box_number'])>0 ){ ?>
                                  #<?= $hand['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $hand['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php if( isset($hand['nendoroid_name']) && strlen($hand['nendoroid_name'])>0 ){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td><a href="nendoroid/<?= $hand['nendoroid_internalid'] ?>/<?= $hand['nendoroid_url'] ?>/"><?= $hand['nendoroid_name'] ?><?php if(isset($hand['nendoroid_version']) && strlen($hand['nendoroid_version'])>0){ ?> - <?= $hand['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
<?php
  tableField('posture','Posture',$hand['hand_posture'],!$hand['db_validatorid']);
  tableField('leftright','Left/right',$hand['hand_leftright'],!$hand['db_validatorid']);
  tableField('skin_color','Skin color',$hand['hand_skin_color'],!$hand['db_validatorid']);
  tableField('description','Description',$hand['hand_description'],!$hand['db_validatorid']);
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
<?php include('mvc/views/pages-sections/others/history.php'); ?>
              </div>
            </div>
