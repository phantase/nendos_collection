                    <div class="row">
<?php
  foreach ($boxes as $box) {
?>
                      <div class="2u 3u(medium) 4u(small)">
                      <?php if($withlinks){ ?>
                        <a href="box/<?= $box['box_internalid'] ?>/<?= $box['box_url'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              box=""
                              box_number="<?= $box['box_number'] ?>"
                              box_name="<?= $box['box_name'] ?>"
                              box_category="<?= $box['box_category'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $box[$sortingfield] ?>">
                          <img src="images/nendos/boxes/<?= $box['box_internalid'] ?>.jpg" alt="" />
                          <span class="info_icons">
<?php if( (isAdministrator() || isValidator() || isEditor() ) && $box['db_validatorid'] ){ ?>
                            <span class="fa-stackb fa-green" title="Validated by <?= $box['db_validatorname'] ?>">
                              <i class="fa fa-stackb-2x fa-square-o"></i>
                              <i class="fa fa-stackb-1x fa-check"></i>
                            </span>
<?php } ?>
<?php if( $box['coll_additiondate'] ){ ?>
                            <span class="fa-stackb fa-orange" title="In collection (<?= intervalFormater($box['coll_additionsince']) ?>)">
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
                    </div>
