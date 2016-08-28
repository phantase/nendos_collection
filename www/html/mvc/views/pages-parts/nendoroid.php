        <!-- Main -->
          <div id="main">
            <div class="inner">
              <section>
                <div class="row">
                  <div class="4u 12u$(medium)">
                    <span class="image fit" id="span_nendoroid<?= $nendoroid['internalid'] ?>">
                      <img src="images/nendos/nendoroids/<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                      <?php if(isset($_SESSION['userid'])){ ?>
                        <i class="icon style2 fa-edit included editpic" id="editpic_nendoroid<?= $nendoroid['internalid'] ?>" title="Add/Change the picture" part="nendoroid" internalid="<?= $nendoroid['internalid'] ?>"></i>
                      <?php } ?>
                    </span>
                    <fieldset class="dropzone image fit" id="drop_nendoroid<?= $nendoroid['internalid'] ?>" style="display:none;">
                      <p>Drop a file here, <br/>or click to browse your computer...</p>
                    </fieldset>
                  </div>
                  <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Box</th>
                            <td><a href="box/<?= $nendoroid['box_name'] ?>_<?= $nendoroid['box_id'] ?>/"><?= $nendoroid['box_type'] ?> #<?= $nendoroid['box_name'] ?></a></td>
                          </tr>
                          <tr>
                            <th>Origin</th>
                            <td><?= $nendoroid['origin'] ?></td>
                          </tr>
                          <tr>
                            <th>Character</th>
                            <td><?= $nendoroid['name'] ?></td>
                          </tr>
<?php
  if( strlen($nendoroid['version'])>0 ){
?>
                          <tr>
                            <th>Version</th>
                            <td><?= $nendoroid['version'] ?></td>
                          </tr>
<?php
  }
?>
                          <tr>
                            <th>Editor</th>
                            <td><?= $nendoroid['editor'] ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="6u 12u$(medium)">
                    <h4>Faces</h4>
                    <?php showFacesListing($faces,"simple",true,true,$nendoroid['box_name'],$nendoroid['box_id'],$nendoroid['url'],$nendoroid['internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hairs</h4>
                    <?php showHairsListing($hairs,"simple",true,true,$nendoroid['box_name'],$nendoroid['box_id'],$nendoroid['url'],$nendoroid['internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hands</h4>
                    <?php showHandsListing($hands,"simple",true,true,$nendoroid['box_name'],$nendoroid['box_id'],$nendoroid['url'],$nendoroid['internalid']); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Body parts</h4>
                    <?php showBodyPartsListing($bodyparts,"simple"); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Accessories</h4>
                    <?php showAccessoriesListing($accessories,"simple"); ?>
                  </div>
                </div>
              </section>
            </div>
          </div>
