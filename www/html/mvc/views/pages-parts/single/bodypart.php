        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_bodypart<?= $bodypart['internalid'] ?>">
                    <img src="images/nendos/bodyparts/<?= $bodypart['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_bodypart<?= $bodypart['internalid'] ?>" title="Add/Change the picture" part="bodypart" internalid="<?= $bodypart['internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_bodypart<?= $bodypart['internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3"><a href="box/<?= $bodypart['box_name'] ?>_<?= $bodypart['box_id'] ?>/"><?= $bodypart['box_type'] ?> #<?= $bodypart['box_name'] ?></a></td>
                          </tr>
<?php if($bodypart['nendoroid_id']){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $bodypart['nendoroid_url'] ?>_<?= $bodypart['nendoroid_id'] ?>/"><?= $bodypart['nendoroid_name'] ?><?php if(isset($bodypart['nendoroid_version']) && strlen($bodypart['nendoroid_version'])>0){ ?> - <?= $bodypart['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Part</th>
                            <td colspan="3"><?= $bodypart['part'] ?></td>
                          </tr>
                          <tr>
                            <th>Main color</th>
                            <td><?= $bodypart['main_color'] ?></td>
                            <th>Other color</th>
                            <td><?= $bodypart['second_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $bodypart['description'] ?></td>
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
