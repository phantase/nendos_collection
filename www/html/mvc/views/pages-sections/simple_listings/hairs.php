                    <div class="row">
<?php
  foreach ($hairs as $hair) {
?>
                      <div class="2u 3u(medium)">
                      <?php if($withlinks){ ?>
                        <a href="face/<?= $face['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" hair="" frontback="<?= $hair['frontback'] ?>" haircut="<?= $hair['haircut'] ?>" description="<?= $hair['description'] ?>">
                          <img src="images/nendos/hairs/<?= $hair['internalid'] ?>.jpg" alt="" />
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_name ?>_<?= $box_id ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_url ?>_<?= $nendoroid_id ?>/<?php } ?>addhair">
                          <span class="image fit withadd" id="withid" title="Add Hair">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
