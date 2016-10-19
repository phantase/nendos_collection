<?php if(count($faces)>0){ ?>
<?php foreach ($faces as $face) { ?>
                              <div class="1u 2u(medium) 3u(small)">
                                  <span class="image fit checked"
                                        internalid="<?= $face['face_internalid'] ?>"
                                        element="face"
                                        face=""
                                        eyes="<?= $face['face_eyes'] ?>"
                                        mouth="<?= $face['face_mouth'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $face[$sortingfield] ?>">
                                    <img src="images/nendos/faces/<?= $face['face_internalid'] ?>.jpg" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
