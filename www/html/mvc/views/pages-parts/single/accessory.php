        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_accessory<?= $accessory['internalid'] ?>">
                    <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_accessory<?= $accessory['internalid'] ?>" title="Add/Change the picture" part="accessory" internalid="<?= $accessory['internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_accessory<?= $accessory['internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3"><a href="box/<?= $accessory['box_name'] ?>_<?= $accessory['box_id'] ?>/"><?= $accessory['box_type'] ?> #<?= $accessory['box_name'] ?></a></td>
                          </tr>
<?php if($accessory['nendoroid_id']){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $accessory['nendoroid_url'] ?>_<?= $accessory['nendoroid_id'] ?>/"><?= $accessory['nendoroid_name'] ?><?php if(isset($accessory['nendoroid_version']) && strlen($accessory['nendoroid_version'])>0){ ?> - <?= $accessory['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Type</th>
                            <td colspan="3"><?= $accessory['type'] ?></td>
                          </tr>
                          <tr>
                            <th>Main color</th>
                            <td><?= $accessory['main_color'] ?></td>
                            <th>Other color</th>
                            <td><?= $accessory['other_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $accessory['description'] ?></td>
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
