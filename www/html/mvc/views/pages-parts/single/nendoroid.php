        <!-- Main -->
          <div id="main">
            <div class="inner">
              <section>
                <div class="row">
                  <div class="4u 12u$(medium)">
                    <span class="image fit" id="span_nendoroid<?= $nendoroid['nendoroid_internalid'] ?>">
                      <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>.jpg" alt="" />
                      <?php if(isset($_SESSION['userid'])){ ?>
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
  tableField('name','Name',$nendoroid['nendoroid_name']);
  tableField('version','Version',$nendoroid['nendoroid_version']);
  tableField('sex','Sex',$nendoroid['nendoroid_sex']);
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="6u 12u$(medium)">
                    <h4>Faces</h4>
<?php showFacesListing($faces,null,true,true,$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hairs</h4>
<?php showHairsListing($hairs,null,true,true,$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hands</h4>
<?php showHandsListing($hands,null,true,true,$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Body parts</h4>
<?php showBodyPartsListing($bodyparts,null,true,true,$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,null,true,true,$nendoroid['box_url'],$nendoroid['box_internalid'],$nendoroid['nendoroid_url'],$nendoroid['nendoroid_internalid']); ?>
                  </div>
                </div>
                <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
              </section>
            </div>
          </div>
