                    <div class="row">
<?php
  foreach ($boxes as $box) {
?>
                      <div class="2u 4u(medium)">
                        <span class="image fit" title="<?= $box['type'] ?> #<?= $box['name'] ?>">
                          <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>
