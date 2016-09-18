        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_accessory<?= $accessory['accessory_internalid'] ?>">
                    <img src="images/nendos/accessories/<?= $accessory['accessory_internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic"
                        id="editpic_accessory<?= $accessory['accessory_internalid'] ?>"
                        title="Add/Change the picture"
                        part="accessory"
                        internalid="<?= $accessory['accessory_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit"
                            id="drop_accessory<?= $accessory['accessory_internalid'] ?>"
                            style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="accessory" internalid="<?= $accessory['accessory_internalid'] ?>">
                        <tbody>
<?php
  tableFieldValidate($accessory['db_validatorid']);
?>
                          <tr>
                            <th>Box</th>
                            <td>
                              <a href="box/<?= $accessory['box_internalid'] ?>/<?= $accessory['box_url'] ?>/">
                                <?= $accessory['box_category'] ?>
                                <?php if( isset($accessory['box_number']) && strlen($accessory['box_number'])>0 ){ ?>
                                  #<?= $accessory['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $accessory['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php if( isset($accessory['nendoroid_name']) && strlen($accessory['nendoroid_name'])>0 ){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td>
                              <a href="nendoroid/<?= $accessory['nendoroid_internalid'] ?>/<?= $accessory['nendoroid_url'] ?>/"><?= $accessory['nendoroid_name'] ?><?php if(isset($accessory['nendoroid_version']) && strlen($accessory['nendoroid_version'])>0){ ?> - <?= $accessory['nendoroid_version'] ?><?php } ?></a>
                            </td>
                          </tr>
<?php } ?>
<?php
  tableField('type','Type',$accessory['accessory_type']);
  tableField('main_color','Main color',$accessory['accessory_main_color']);
  tableField('other_color','Other color',$accessory['accessory_other_color']);
  tableField('description','Description',$accessory['accessory_description']);
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
