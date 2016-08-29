        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_face<?= $face['internalid'] ?>">
                    <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_face<?= $face['internalid'] ?>" title="Add/Change the picture" part="face" internalid="<?= $face['internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_face<?= $face['internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3"><a href="box/<?= $face['box_name'] ?>_<?= $face['box_id'] ?>/"><?= $face['box_type'] ?> #<?= $face['box_name'] ?></a></td>
                          </tr>
<?php if($face['nendoroid_id']){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $face['nendoroid_url'] ?>_<?= $face['nendoroid_id'] ?>/"><?= $face['nendoroid_name'] ?><?php if(isset($face['nendoroid_version']) && strlen($face['nendoroid_version'])>0){ ?> - <?= $face['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Eyes</th>
                            <td colspan="2"><?= $face['eyes'] ?></td>
                            <td><?= $face['eyes_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Mouth</th>
                            <td colspan="3"><?= $face['mouth'] ?></td>
                          </tr>
                          <tr>
                            <th>Skin</th>
                            <td><?= $face['skin_color'] ?></td>
                            <th>Sex</th>
                            <td><?= $face['sex'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
