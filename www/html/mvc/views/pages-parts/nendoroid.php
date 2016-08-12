        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h1><?= $nendoroid['origin'] ?> - <?= $nendoroid['name'] ?></h1>
              </header>
              <section>
                <div class="row">
                  <div class="2u 12u$(medium)">
                    <span class="image fit">
                      <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                    </span>
                  </div>
                  <div class="6u 12u$(medium)">
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
                  <div class="4u$ 12u$(medium)">
                    <h4>Faces</h4>
                    <div class="row">
<?php
  foreach ($faces as $face) {
?>
                      <div class="4u">
                        <span class="image fit tooltip">
                          <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                          <span class="tooltiptext">Eyes: <?= $face['eyes'] ?><br/>Mouth: <?= $face['mouth'] ?></span>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
                    <h4>Hairs</h4>
                    <div class="row">
<?php
  foreach ($hairs as $hair) {
?>
                      <div class="4u">
                        <span class="image fit tooltip">
                          <img src="images/nendos/hairs/<?= $hair['internalid'] ?>.jpg" alt="" />
                          <span class="tooltiptext"><?= $hair['frontback'] ?><br/>Haircut: <?= $hair['haircut'] ?><br/>Description: <?= $hair['description'] ?></span>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
                    <h4>Hands</h4>
                    <div class="row">
<?php
  foreach ($hands as $hand) {
?>
                      <div class="3u">
                        <span class="image fit tooltip">
                          <img src="images/nendos/hands/<?= $hand['internalid'] ?>.jpg" alt="" />
                          <span class="tooltiptext"><?= $hand['leftright'] ?><br/>Posture: <?= $hand['posture'] ?></span>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
                    <h4>Body Parts</h4>
                    <div class="row">
<?php
  foreach ($body_parts as $body_part) {
?>
                      <div class="3u">
                        <span class="image fit tooltip">
                          <img src="images/nendos/body_parts/<?= $body_part['internalid'] ?>.jpg" alt="" />
                          <span class="tooltiptext"><?= $body_part['part'] ?><br/>Description: <?= $body_part['description'] ?></span>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
                    <h4>Accessories</h4>
                    <div class="row">
<?php
  foreach ($accessories as $accessory) {
?>
                      <div class="4u">
                        <span class="image fit tooltip">
                          <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>.jpg" alt="" />
                          <span class="tooltiptext"><?= $accessory['type'] ?><br/>Description: <?= $accessory['description'] ?></span>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
