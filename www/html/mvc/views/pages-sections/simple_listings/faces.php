                    <div class="row">
<?php
  foreach ($faces as $face) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" face="" eyes="<?= $face['eyes'] ?>" mouth="<?= $face['mouth'] ?>">
                          <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit withadd" id="withid" title="Add a face">
                          <p><i class="icon fa-plus"></i></p>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
