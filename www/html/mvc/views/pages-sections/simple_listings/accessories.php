                   <div class="row">
<?php
  foreach ($accessories as $accessory) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="accessory/<?= $accessory['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" accessory="<?= $accessory['accessory'] ?>" description="<?= $accessory['description'] ?>" >
                          <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>.jpg" alt="" />
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_name ?>_<?= $box_id ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_url ?>_<?= $nendoroid_id ?>/<?php } ?>addaccessory">
                          <span class="image fit withadd" id="withid" title="Add Accessory">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
