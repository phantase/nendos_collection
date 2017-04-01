<?php if(count($faces)>0){ ?>
<?php foreach ($faces as $face) { ?>
                              <div class="1u 2u(medium) 3u(small)">
<?php if( $face['coll_additiondate'] ){ ?>
                                <span class="image fit owned"
<?php } else { ?>
                                <span class="image fit checked"
<?php } ?>
                                        internalid="<?= $face['face_internalid'] ?>"
                                        element="face"
                                        face=""
                                        eyes="<?= $face['face_eyes'] ?>"
                                        mouth="<?= $face['face_mouth'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $face[$sortingfield] ?>">
                                    <img src="images/nendos/faces/<?= $face['face_internalid'] ?>_thumb" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
