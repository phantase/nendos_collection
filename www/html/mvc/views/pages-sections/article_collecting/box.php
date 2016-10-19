                              <div class="1u 2u(medium) 3u(small)">
<?php if( $box['coll_additiondate'] ){ ?>
                                <span class="image fit owned"
<?php } else { ?>
                                <span class="image fit checked"
<?php } ?>
                                      internalid="<?= $box['box_internalid'] ?>"
                                      element="box"
                                      box=""
                                      box_number="<?= $box['box_number'] ?>"
                                      box_name="<?= $box['box_name'] ?>"
                                      box_category="<?= $box['box_category'] ?>"
                                      sortingfield="<?= $sortingfield ?>"
                                      sortingvalue="<?= $box[$sortingfield] ?>">
                                  <img src="images/nendos/boxes/<?= $box['box_internalid'] ?>.jpg" alt="" />
                                </span>
                              </div>
