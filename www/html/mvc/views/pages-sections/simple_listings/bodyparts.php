                    <div class="row">
<?php
  foreach ($bodyparts as $bodypart) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" bodypart="<?= $bodypart['part'] ?>" description="<?= $bodypart['description'] ?>" >
                          <img src="images/nendos/bodyparts/<?= $bodypart['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>

