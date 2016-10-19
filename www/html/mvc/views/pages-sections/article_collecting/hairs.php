<?php if(count($hairs)>0){ ?>
<?php foreach ($hairs as $hair) { ?>
                              <div class="1u 2u(medium) 3u(small)">
                                  <span class="image fit checked"
                                        internalid="<?= $hair['hair_internalid'] ?>"
                                        element="hair"
                                        hair=""
                                        frontback="<?= $hair['hair_frontback'] ?>"
                                        haircut="<?= $hair['hair_haircut'] ?>"
                                        description="<?= $hair['hair_description'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $hair[$sortingfield] ?>">
                                    <img src="images/nendos/hairs/<?= $hair['hair_internalid'] ?>.jpg" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
