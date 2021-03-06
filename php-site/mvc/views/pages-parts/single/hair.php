        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_hair<?= $hair['hair_internalid'] ?>">
                    <img src="images/nendos/hairs/<?= $hair['hair_internalid'] ?>_thumb" alt="" />
                    <?php if( isEditor() && ! $hair['db_validatorid'] ){ ?>
                      <i class="icon style2 fa-edit included editpic"
                        id="editpic_hair<?= $hair['hair_internalid'] ?>"
                        title="Add/Change the picture"
                        part="hair"
                        internalid="<?= $hair['hair_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit"
                            id="drop_hair<?= $hair['hair_internalid'] ?>"
                            style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="hair" internalid="<?= $hair['hair_internalid'] ?>">
                        <tbody>
<?php
  tableFieldValidate($hair['db_validatorid']);
  tableFieldOwned($hair['coll_additiondate'],$hair['coll_additionsince']);
?>
                          <tr>
                            <th>Box</th>
                            <td>
                              <a href="box/<?= $hair['box_internalid'] ?>/<?= $hair['box_url'] ?>/">
                                <?= $hair['box_category'] ?>
                                <?php if( isset($hair['box_number']) && strlen($hair['box_number'])>0 ){ ?>
                                  #<?= $hair['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $hair['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php if( isset($hair['nendoroid_name']) && strlen($hair['nendoroid_name'])>0 ){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td><a href="nendoroid/<?= $hair['nendoroid_internalid'] ?>/<?= $hair['nendoroid_url'] ?>/"><?= $hair['nendoroid_name'] ?><?php if(isset($hair['nendoroid_version']) && strlen($hair['nendoroid_version'])>0){ ?> - <?= $hair['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
<?php
  tableField('haircut','Haircut',$hair['hair_haircut'],!$hair['db_validatorid']);
  tableField('frontback','Front/Back',$hair['hair_frontback'],!$hair['db_validatorid']);
  tableField('main_color','Main color',$hair['hair_main_color'],!$hair['db_validatorid']);
  tableField('other_color','Other color',$hair['hair_other_color'],!$hair['db_validatorid']);
  tableField('description','Description',$hair['hair_description'],!$hair['db_validatorid']);
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
