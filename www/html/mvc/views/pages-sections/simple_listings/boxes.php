                    <div class="row">
<?php
  foreach ($boxes as $box) {
?>
                      <div class="2u 3u(medium) 4u(small)">
                      <?php if($withlinks){ ?>
                        <a href="box/<?= $box['name'] ?>_<?= $box['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" title="<?= $box['type'] ?> #<?= $box['name'] ?>">
                          <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
                    </div>
