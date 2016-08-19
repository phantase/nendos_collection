                    <div class="row">
<?php
  foreach ($hands as $hand) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" hand="" leftright="<?= $hand['leftright'] ?>" posture="<?= $hand['posture'] ?>" >
                          <img src="images/nendos/hands/<?= $hand['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>
