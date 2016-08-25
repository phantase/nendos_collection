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
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit withadd" id="withid" title="Add some hairs">
                          <p><i class="icon fa-plus"></i></p>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
