<?php if(count($nendoroids)>0){ ?>
<?php foreach ($nendoroids as $nendoroid) { ?>
                              <div class="1u 2u(medium) 3u(small)">
                                  <span class="image fit checked"
                                        internalid="<?= $nendoroid['nendoroid_internalid'] ?>"
                                        element="nendoroid"
                                        nendoroid=""
                                        nendoroid_name="<?= $nendoroid['nendoroid_name'] ?>"
                                        nendoroid_version="<?= $nendoroid['nendoroid_version'] ?>"
                                        box_number="<?= $nendoroid['box_number'] ?>"
                                        box_category="<?= $nendoroid['box_category'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $nendoroid[$sortingfield] ?>">
                                    <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>.jpg" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
