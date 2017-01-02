        <!-- Main -->
          <div id="main">
            <div class="inner">
              <section>
                <div class="row">
                  <div class="4u 12u$(medium)">
                    <span class="image fit" id="span_nendoroid<?= $nendoroid['nendoroid_internalid'] ?>">
                      <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>.jpg" alt="" />
                      <?php if( isEditor() && ! $nendoroid['db_validatorid'] ){ ?>
                        <i class="icon style2 fa-edit included editpic" id="editpic_nendoroid<?= $nendoroid['nendoroid_internalid'] ?>" title="Add/Change the picture" part="nendoroid" internalid="<?= $nendoroid['nendoroid_internalid'] ?>"></i>
                      <?php } ?>
                    </span>
                    <fieldset class="dropzone image fit" id="drop_nendoroid<?= $nendoroid['nendoroid_internalid'] ?>" style="display:none;">
                      <p>Drop a file here, <br/>or click to browse your computer...</p>
                    </fieldset>
                  </div>
                  <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="nendoroid" internalid="<?= $nendoroid['nendoroid_internalid'] ?>">
                        <tbody>
<?php
  tableFieldValidate($nendoroid['db_validatorid']);
  tableFieldOwned($nendoroid['coll_additiondate'],$nendoroid['coll_additionsince']);
?>
                          <tr>
                            <th>Box</th>
                            <td>
                              <a href="box/<?= $nendoroid['box_internalid'] ?>/<?= $nendoroid['box_url'] ?>/">
                                <?= $nendoroid['box_category'] ?>
                                <?php if( isset($nendoroid['box_number']) && strlen($nendoroid['box_number'])>0 ){ ?>
                                  #<?= $nendoroid['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $nendoroid['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php
  tableField('name','Name',$nendoroid['nendoroid_name'],!$nendoroid['db_validatorid']);
  tableField('version','Version',$nendoroid['nendoroid_version'],!$nendoroid['db_validatorid']);
  tableField('sex','Sex',$nendoroid['nendoroid_sex'],!$nendoroid['db_validatorid']);
  tableFieldWithColor('dominant_color','Dominant color',$nendoroid['nendoroid_dominant_color'],!$nendoroid['db_validatorid']);
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
<?php if(isEditor() || count($faces)>0){ ?>
                  <div class="6u 12u$(medium)">
                    <h4>Faces</h4>
<?php showFacesListing($faces,null,true,!$nendoroid['db_validatorid'],$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
<?php } ?>
<?php if(isEditor() || count($hairs)>0){ ?>
                  <div class="6u 12u$(medium)">
                    <h4>Hairs</h4>
<?php showHairsListing($hairs,null,true,!$nendoroid['db_validatorid'],$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
<?php } ?>
<?php if(isEditor() || count($hands)>0){ ?>
                  <div class="6u 12u$(medium)">
                    <h4>Hands</h4>
<?php showHandsListing($hands,array('withlinks'=>true,
                                    'withadd'=>!$nendoroid['db_validatorid'],
                                    'box_url'=>$nendoroid['box_url'],
                                    'box_id'=>$nendoroid['box_internalid'],
                                    'nendoroid_url'=>$nendoroid['nendoroid_url'],
                                    'nendoroid_id'=>$nendoroid['nendoroid_internalid'])); ?>
                  </div>
<?php } ?>
<?php if(isEditor() || count($bodyparts)>0){ ?>
                  <div class="6u 12u$(medium)">
                    <h4>Body parts</h4>
<?php showBodyPartsListing($bodyparts,array('withlinks'=>true,
                                            'withadd'=>!$nendoroid['db_validatorid'],
                                            'box_url'=>$nendoroid['box_url'],
                                            'box_id'=>$nendoroid['box_internalid'],
                                            'nendoroid_url'=>$nendoroid['nendoroid_url'],
                                            'nendoroid_id'=>$nendoroid['nendoroid_internalid'])); ?>
                  </div>
<?php } ?>
<?php if(isEditor() || count($accessories)>0){ ?>
                  <div class="6u 12u$(medium)">
                    <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,array('withlinks'=>true,
                                                'withadd'=>!$nendoroid['db_validatorid'],
                                                'box_url'=>$nendoroid['box_url'],
                                                'box_id'=>$nendoroid['box_internalid'],
                                                'nendoroid_url'=>$nendoroid['nendoroid_url'],
                                                'nendoroid_id'=>$nendoroid['nendoroid_internalid'])); ?>
                  </div>
<?php } ?>
                </div>
                <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
<?php include('mvc/views/pages-sections/others/history.php'); ?>
              </section>
            </div>
          </div>
