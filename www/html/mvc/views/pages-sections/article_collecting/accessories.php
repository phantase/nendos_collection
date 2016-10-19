<?php if(count($accessories)>0){ ?>
<?php foreach ($accessories as $accessory) { ?>
                              <div class="1u 2u(medium) 3u(small)">
                                  <span class="image fit checked"
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
