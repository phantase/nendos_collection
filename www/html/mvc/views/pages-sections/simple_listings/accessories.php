<?php if(!$shareddiv){ ?>
                    <div class="row">
<?php } ?>
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
                          <span class="info_icons">
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $accessory['db_validatorid'] ){ ?>
                            <span class="fa-stackb fa-green" title="Validated by <?= $accessory['db_validatorname'] ?>">
                              <i class="fa fa-stackb-2x fa-square-o"></i>
                              <i class="fa fa-stackb-1x fa-check"></i>
                            </span>
<?php } ?>
<?php if( $accessory['coll_additiondate'] ){ ?>
                            <span class="fa-stackb fa-orange" title="Owned (added <?= intervalFormater($accessory['coll_additionsince']) ?>)">
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addaccessory">
                          <span class="image fit withadd" id="withid" title="Add Accessory">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
<?php if(!$shareddiv){ ?>
                    </div>
<?php } ?>
