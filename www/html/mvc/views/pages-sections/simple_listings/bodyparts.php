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
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="2u 3u(medium)">
                        <span class="image fit withadd" id="withid" title="Add a body part">
                          <p><i class="icon fa-plus"></i></p>
                        </span>
                      </div>
<?php
  }
?>
                    </div>

