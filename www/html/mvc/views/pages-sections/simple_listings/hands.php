                    <div class="row">
<?php
  foreach ($hands as $hand) {
?>
                      <div class="2u 3u(medium)">
                      <?php if($withlinks){ ?>
                        <a href="hand/<?= $hand['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" hand="" leftright="<?= $hand['leftright'] ?>" posture="<?= $hand['posture'] ?>" >
                          <img src="images/nendos/hands/<?= $hand['internalid'] ?>.jpg" alt="" />
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
                      <div class="2u 3u(medium)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_name ?>_<?= $box_id ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_url ?>_<?= $nendoroid_id ?>/<?php } ?>addhand">
                          <span class="image fit withadd" id="withid" title="Add a hand">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
