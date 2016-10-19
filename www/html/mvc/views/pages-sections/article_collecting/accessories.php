<?php if(count($accessories)>0){ ?>
<?php foreach ($accessories as $accessory) { ?>
                              <div class="1u 2u(medium) 3u(small)">
<?php if( $accessory['coll_additiondate'] ){ ?>
                                <span class="image fit owned"
<?php } else { ?>
                                <span class="image fit checked"
<?php } ?>
                                        internalid="<?= $accessory['accessory_internalid'] ?>"
                                        element="accessory"
                                        accessory=""
                                        type="<?= $accessory['accessory_type'] ?>"
                                        description="<?= $accessory['accessory_description'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $accessory[$sortingfield] ?>">
                                    <img src="images/nendos/accessories/<?= $accessory['accessory_internalid'] ?>.jpg" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
