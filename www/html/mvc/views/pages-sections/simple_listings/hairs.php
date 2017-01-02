<?php if(!$shareddiv){ ?>
                    <div class="row">
<?php } ?>
<?php
  foreach ($hairs as $hair) {
?>
                      <div class="2u 3u(small)">
                      <?php if($withlinks){ ?>
                        <a href="hair/<?= $hair['hair_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              hair=""
                              frontback="<?= $hair['hair_frontback'] ?>"
                              haircut="<?= $hair['hair_haircut'] ?>"
                              description="<?= $hair['hair_description'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $hair[$sortingfield] ?>">
                          <img src="images/nendos/hairs/<?= $hair['hair_internalid'] ?>.jpg" alt="" />
                          <span class="info_icons">
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $hair['db_validatorid'] ){ ?>
                            <span class="fa-stackb fa-green" title="Validated by <?= $hair['db_validatorname'] ?>">
                              <i class="fa fa-stackb-2x fa-square-o"></i>
                              <i class="fa fa-stackb-1x fa-check"></i>
                            </span>
<?php } ?>
<?php if( $hair['coll_additiondate'] ){ ?>
                            <span class="fa-stackb fa-orange" title="Owned (added <?= intervalFormater($hair['coll_additionsince']) ?>)">
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
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?><?php if(isset($nendoroid_id)){ ?>nendoroid/<?= $nendoroid_id ?>/<?= $nendoroid_url ?>/<?php } ?>addhair">
                          <span class="image fit withadd" id="withid" title="Add Hair">
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
