                   <div class="row">
<?php
  foreach ($accessories as $accessory) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="accessory/<?= $accessory['accessory_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              accessory=""
                              type="<?= $accessory['accessory_type'] ?>"
                              description="<?= $accessory['accessory_description'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $accessory[$sortingfield] ?>">
                          <img src="images/nendos/accessories/<?= $accessory['accessory_internalid'] ?>.jpg" alt="" />
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addaccessory">
                          <span class="image fit withadd" id="withid" title="Add Accessory">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
