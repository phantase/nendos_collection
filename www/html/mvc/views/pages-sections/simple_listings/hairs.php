                    <div class="row">
<?php
  foreach ($hairs as $hair) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="hair/<?= $hair['internalid'] ?>/">
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
                      <div class="2u 3u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addhair">
                          <span class="image fit withadd" id="withid" title="Add Hair">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
