                    <div class="row">
<?php
  foreach ($hands as $hand) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="hand/<?= $hand['hand_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              hand=""
                              leftright="<?= $hand['hand_leftright'] ?>"
                              posture="<?= $hand['hand_posture'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $hand[$sortingfield] ?>">
                          <img src="images/nendos/hands/<?= $hand['hand_internalid'] ?>.jpg" alt="" />
                          <span class="info_icons">
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $hand['db_validatorid'] ){ ?>
                            <span class="fa-stackb fa-green" title="Validated by <?= $hand['db_validatorname'] ?>">
                              <i class="fa fa-stackb-2x fa-square-o"></i>
                              <i class="fa fa-stackb-1x fa-check"></i>
                            </span>
<?php } ?>
<?php if( $hand['coll_additiondate'] ){ ?>
                            <span class="fa-stackb fa-orange" title="Owned (added <?= intervalFormater($hand['coll_additionsince']) ?>)">
                              <i class="fa fa-square-o fa-stackb-2x"></i>
                              <i class="fa fa-suitcase fa-stackb-1x"></i>
                            </span>
<?php } ?>
                          </span>
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
