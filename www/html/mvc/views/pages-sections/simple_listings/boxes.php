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
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
                    </div>
