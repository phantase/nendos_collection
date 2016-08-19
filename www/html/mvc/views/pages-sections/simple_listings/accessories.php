                   <div class="row">
<?php
  foreach ($accessories as $accessory) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" accessory="<?= $accessory['type'] ?>" description="<?= $accessory['description'] ?>" >
                          <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>
