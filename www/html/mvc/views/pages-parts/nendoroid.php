        <!-- Main -->
          <div id="main">
            <div class="inner">
              <section>
                <div class="row">
                  <div class="4u 12u$(medium)">
                    <span class="image fit">
                      <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                    </span>
                  </div>
                  <div class="8u 12u$(medium)">
                    <div class="table-wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <th>Nendoroid #</th>
                            <td><?= $nendoroid['box_name'] ?></td>
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
                    <?php showFacesListing($faces,"simple",null); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hairs</h4>
                    <?php showHairsListing($hairs,"simple",null); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Hands</h4>
                    <?php showHandsListing($hands,"simple",null); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Body parts</h4>
                    <?php showBodyPartsListing($bodyparts,"simple",null); ?>
                  </div>
                  <div class="6u 12u$(medium)">
                    <h4>Accessories</h4>
                    <?php showAccessoriesListing($accessories,"simple",null); ?>
                  </div>
                </div>
              </section>
            </div>
          </div>
