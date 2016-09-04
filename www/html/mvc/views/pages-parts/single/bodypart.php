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
                      <table>
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
                          <tr>
                            <th>Part</th>
                            <td colspan="3"><?= $bodypart['bodypart_part'] ?></td>
                          </tr>
                          <tr>
                            <th>Main color</th>
                            <td><?= $bodypart['bodypart_main_color'] ?></td>
                            <th>Other color</th>
                            <td><?= $bodypart['bodypart_other_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $bodypart['bodypart_description'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
              </div>
            </div>
