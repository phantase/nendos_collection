<?php if(count($bodyparts)>0){ ?>
<?php foreach ($bodyparts as $bodypart) { ?>
                              <div class="1u 2u(medium) 3u(small)">
<?php if( $bodypart['coll_additiondate'] ){ ?>
                                <span class="image fit owned"
<?php } else { ?>
                                <span class="image fit checked"
<?php } ?>
                                        internalid="<?= $bodypart['bodypart_internalid'] ?>"
                                        element="bodypart"
                                        bodypart=""
                                        part="<?= $bodypart['bodypart_part'] ?>"
                                        description="<?= $bodypart['bodypart_description'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $bodypart[$sortingfield] ?>">
                                    <img src="images/nendos/bodyparts/<?= $bodypart['bodypart_internalid'] ?>_thumb" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
