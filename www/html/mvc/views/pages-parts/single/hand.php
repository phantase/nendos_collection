        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_hand<?= $hand['internalid'] ?>">
                    <img src="images/nendos/hands/<?= $hand['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_hand<?= $hand['internalid'] ?>" title="Add/Change the picture" part="hand" internalid="<?= $hand['internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_hand<?= $hand['internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3"><a href="box/<?= $hand['box_name'] ?>_<?= $hand['box_id'] ?>/"><?= $hand['box_type'] ?> #<?= $hand['box_name'] ?></a></td>
                          </tr>
<?php if($hand['nendoroid_id']){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $hand['nendoroid_url'] ?>_<?= $hand['nendoroid_id'] ?>/"><?= $hand['nendoroid_name'] ?><?php if(isset($hand['nendoroid_version']) && strlen($hand['nendoroid_version'])>0){ ?> - <?= $hand['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Posture</th>
                            <td><?= $hand['posture'] ?></td>
                            <td><?= $hand['leftright'] ?></td>
                            <td><?= $hand['skin_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $hand['description'] ?></td>
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
