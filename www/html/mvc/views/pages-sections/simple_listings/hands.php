                    <div class="row">
<?php
  foreach ($hands as $hand) {
?>
                      <div class="2u 3u(small)">
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
                      <div class="2u 3u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addhand">
                          <span class="image fit withadd" id="withid" title="Add a hand">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
