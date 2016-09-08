        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_bodypart<?= $bodypart['bodypart_internalid'] ?>">
                    <img src="images/nendos/bodyparts/<?= $bodypart['bodypart_internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic"
                        id="editpic_bodypart<?= $bodypart['bodypart_internalid'] ?>"
                        title="Add/Change the picture"
                        part="bodypart"
                        internalid="<?= $bodypart['bodypart_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit"
                            id="drop_bodypart<?= $bodypart['bodypart_internalid'] ?>"
                            style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="bodypart" internalid="<?= $bodypart['bodypart_internalid'] ?>">
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3">
                              <a href="box/<?= $bodypart['box_internalid'] ?>/<?= $bodypart['box_url'] ?>/">
                                <?= $bodypart['box_category'] ?>
                                <?php if( isset($bodypart['box_number']) && strlen($bodypart['box_number'])>0 ){ ?>
                                  #<?= $bodypart['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $bodypart['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php if( isset($bodypart['nendoroid_name']) && strlen($bodypart['nendoroid_name'])>0 ){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $bodypart['nendoroid_internalid'] ?>/<?= $bodypart['nendoroid_url'] ?>/"><?= $bodypart['nendoroid_name'] ?><?php if(isset($bodypart['nendoroid_version']) && strlen($bodypart['nendoroid_version'])>0){ ?> - <?= $bodypart['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
<?php
  tableField('part','Part',$bodypart['bodypart_part']);
  tableField('main_color','Main color',$bodypart['bodypart_main_color']);
  tableField('other_color','Other color',$bodypart['bodypart_other_color']);
  tableField('description','Description',$bodypart['bodypart_description']);
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
