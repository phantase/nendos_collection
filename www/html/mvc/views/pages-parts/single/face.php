        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_face<?= $face['face_internalid'] ?>">
                    <img src="images/nendos/faces/<?= $face['face_internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic"
                        id="editpic_face<?= $face['face_internalid'] ?>"
                        title="Add/Change the picture"
                        part="face"
                        internalid="<?= $face['face_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit"
                            id="drop_face<?= $face['face_internalid'] ?>"
                            style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table id="info_table" element="face" internalid="<?= $face['face_internalid'] ?>">
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td>
                              <a href="box/<?= $face['box_internalid'] ?>/<?= $face['box_url'] ?>/">
                                <?= $face['box_category'] ?>
                                <?php if( isset($face['box_number']) && strlen($face['box_number'])>0 ){ ?>
                                  #<?= $face['box_number'] ?>
                                <?php } ?>
                                <br/>
                                <?= $face['box_name'] ?>
                              </a>
                            </td>
                          </tr>
<?php if( isset($face['nendoroid_name']) && strlen($face['nendoroid_name'])>0 ){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td><a href="nendoroid/<?= $face['nendoroid_internalid'] ?>/<?= $face['nendoroid_url'] ?>/"><?= $face['nendoroid_name'] ?><?php if(isset($face['nendoroid_version']) && strlen($face['nendoroid_version'])>0){ ?> - <?= $face['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
<?php
  tableField('eyes','Eyes',$face['face_eyes']);
  tableField('eyes_color','Eyes color',$face['face_eyes_color']);
  tableField('mouth','Mouth',$face['face_mouth']);
  tableField('skin_color','Skin color',$face['face_skin_color']);
  tableField('sex','Sex',$face['face_sex']);
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
              </div>
            </div>
