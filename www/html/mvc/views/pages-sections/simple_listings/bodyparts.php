                    <div class="row">
<?php
  foreach ($bodyparts as $bodypart) {
?>
                      <div class="2u 3u(medium)">
                      <?php if($withlinks){ ?>
                        <a href="bodypart/<?= $bodypart['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" bodypart="<?= $bodypart['part'] ?>" description="<?= $bodypart['description'] ?>" >
                          <img src="images/nendos/bodyparts/<?= $bodypart['internalid'] ?>.jpg" alt="" />
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_name ?>_<?= $box_id ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_url ?>_<?= $nendoroid_id ?>/<?php } ?>addbodypart">
                          <span class="image fit withadd" id="withid" title="Add Bodypart">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>

