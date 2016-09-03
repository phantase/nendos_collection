                    <div class="row">
<?php
  foreach ($faces as $face) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="face/<?= $face['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" face="" eyes="<?= $face['eyes'] ?>" mouth="<?= $face['mouth'] ?>">
                          <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addface">
                          <span class="image fit withadd" id="withid" title="Add a face">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
