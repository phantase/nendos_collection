        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_hair<?= $hair['internalid'] ?>">
                    <img src="images/nendos/hairs/<?= $hair['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_hair<?= $hair['internalid'] ?>" title="Add/Change the picture" part="hair" internalid="<?= $hair['internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_hair<?= $hair['internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3"><a href="box/<?= $hair['box_name'] ?>_<?= $hair['box_id'] ?>/"><?= $hair['box_type'] ?> #<?= $hair['box_name'] ?></a></td>
                          </tr>
<?php if($hair['nendoroid_id']){ ?>
                          <tr>
                            <th>Nendoroid</th>
                            <td colspan="3"><a href="nendoroid/<?= $hair['nendoroid_url'] ?>_<?= $hair['nendoroid_id'] ?>/"><?= $hair['nendoroid_name'] ?><?php if(isset($hair['nendoroid_version']) && strlen($hair['nendoroid_version'])>0){ ?> - <?= $hair['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Haircut</th>
                            <td colspan="2"><?= $hair['haircut'] ?></td>
                            <td><?= $hair['frontback'] ?></td>
                          </tr>
                          <tr>
                            <th>Main color</th>
                            <td><?= $hair['main_color'] ?></td>
                            <th>Other color</th>
                            <td><?= $hair['other_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $hair['description'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
