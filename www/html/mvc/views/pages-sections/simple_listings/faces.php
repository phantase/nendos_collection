                    <div class="row">
<?php
  foreach ($faces as $face) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="face/<?= $face['face_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              face=""
                              eyes="<?= $face['face_eyes'] ?>"
                              mouth="<?= $face['face_mouth'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $face[$sortingfield] ?>">
                          <img src="images/nendos/faces/<?= $face['face_internalid'] ?>.jpg" alt="" />
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $face['db_validatorid'] ){ ?>
                          <i class="icon fa-check-square-o validationicon" title="Validated by <?= $face['db_validatorname'] ?>"></i>
<?php } ?>
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
