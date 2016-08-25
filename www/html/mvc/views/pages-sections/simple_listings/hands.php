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
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit withadd" id="withid" title="Add a hand">
                          <p><i class="icon fa-plus"></i></p>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
