                    <div class="row">
<?php
  foreach ($bodyparts as $bodypart) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="bodypart/<?= $bodypart['bodypart_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              bodypart=""
                              part="<?= $bodypart['bodypart_part'] ?>"
                              description="<?= $bodypart['bodypart_description'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $bodypart[$sortingfield] ?>">
                          <img src="images/nendos/bodyparts/<?= $bodypart['bodypart_internalid'] ?>.jpg" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
<?php
  if( $withadd && isEditor() ){
?>
                      <div class="2u 3u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addbodypart">
                          <span class="image fit withadd" id="withid" title="Add Bodypart">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>

