                    <div class="row">
<?php
  foreach ($hairs as $hair) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" hair="" frontback="<?= $hair['frontback'] ?>" haircut="<?= $hair['haircut'] ?>" description="<?= $hair['description'] ?>">
                          <img src="images/nendos/hairs/<?= $hair['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>
