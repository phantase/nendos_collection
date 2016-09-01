                    <div class="row">
<?php
  foreach ($boxes as $box) {
?>
                      <div class="2u 3u(medium) 4u(small)">
                      <?php if($withlinks){ ?>
                        <a href="box/<?= $box['box_internalid'] ?>/<?= $box['box_url'] ?>/">
                      <?php } ?>
                        <span class="image fit" box="" number="<?= $box['box_number'] ?>"  name="<?= $box['box_name'] ?>"category="<?= $box['box_category'] ?>">
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
