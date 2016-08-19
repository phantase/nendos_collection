                    <div class="row">
<?php
  foreach ($faces as $face) {
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit" face="" eyes="<?= $face['eyes'] ?>" mouth="<?= $face['mouth'] ?>">
                          <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                        </span>
                      </div>
<?php
  }
?>
                    </div>
