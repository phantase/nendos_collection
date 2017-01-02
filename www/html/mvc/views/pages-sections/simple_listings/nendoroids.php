<?php if(!$shareddiv){ ?>
                    <div class="row">
<?php } ?>
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                      <div class="3u 4u(medium) 6u(small)">
                      <?php if($withlinks){ ?>
                        <a href="nendoroid/<?= $nendoroid['nendoroid_internalid'] ?>/<?= $nendoroid['nendoroid_url'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              nendoroid=""
                              nendoroid_name="<?= $nendoroid['nendoroid_name'] ?>"
                              nendoroid_version="<?= $nendoroid['nendoroid_version'] ?>"
                              box_number="<?= $nendoroid['box_number'] ?>"
                              box_category="<?= $nendoroid['box_category'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $nendoroid[$sortingfield] ?>">
                          <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>.jpg" alt="" />
                          <span class="info_icons">
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $nendoroid['db_validatorid'] ){ ?>
                            <span class="fa-stackb fa-green" title="Validated by <?= $nendoroid['db_validatorname'] ?>">
                              <i class="fa fa-stackb-2x fa-square-o"></i>
                              <i class="fa fa-stackb-1x fa-check"></i>
                            </span>
<?php } ?>
<?php if( $nendoroid['coll_additiondate'] ){ ?>
                            <span class="fa-stackb fa-orange" title="Owned (added <?= intervalFormater($nendoroid['coll_additionsince']) ?>)">
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
                      <div class="3u 4u(medium) 6u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?>addnendoroid">
                          <span class="image fit withadd" id="withadd_nendoroid" title="Add a Nendoroid">
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
