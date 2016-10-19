<?php if(count($hands)>0){ ?>
<?php foreach ($hands as $hand) { ?>
                              <div class="1u 2u(medium) 3u(small)">
                                  <span class="image fit checked"
                                        hand=""
                                        leftright="<?= $hand['hand_leftright'] ?>"
                                        posture="<?= $hand['hand_posture'] ?>"
                                        sortingfield="<?= $sortingfield ?>"
                                        sortingvalue="<?= $hand[$sortingfield] ?>">
                                    <img src="images/nendos/hands/<?= $hand['hand_internalid'] ?>.jpg" alt="" />
                                  </span>
                              </div>
<?php } // foreach ?>
<?php } // if(count( ?>
