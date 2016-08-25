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
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit withadd" id="withid" title="Add an accessory">
                          <p><i class="icon fa-plus"></i></p>
                        </span>
                      </div>
<?php
  }
?>
                    </div>
