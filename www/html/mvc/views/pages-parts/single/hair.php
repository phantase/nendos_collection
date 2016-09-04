        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit" id="span_hair<?= $hair['hair_internalid'] ?>">
                    <img src="images/nendos/hairs/<?= $hair['hair_internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
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
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td colspan="3">
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
                            <td colspan="3"><a href="nendoroid/<?= $hair['nendoroid_internalid'] ?>/<?= $hair['nendoroid_url'] ?>/"><?= $hair['nendoroid_name'] ?><?php if(isset($hair['nendoroid_version']) && strlen($hair['nendoroid_version'])>0){ ?> - <?= $hair['nendoroid_version'] ?><?php } ?></a></td>
                          </tr>
<?php } ?>
                          <tr>
                            <th>Haircut</th>
                            <td colspan="2"><?= $hair['hair_haircut'] ?></td>
                            <td><?= $hair['hair_frontback'] ?></td>
                          </tr>
                          <tr>
                            <th>Main color</th>
                            <td><?= $hair['hair_main_color'] ?></td>
                            <th>Other color</th>
                            <td><?= $hair['hair_other_color'] ?></td>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <td colspan="3"><?= $hair['hair_description'] ?></td>
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
