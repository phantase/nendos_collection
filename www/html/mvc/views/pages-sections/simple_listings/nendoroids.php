                    <div class="row">
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                      <div class="3u 4u(medium) 6u(small)">
                      <?php if($withlinks){ ?>
                        <a href="nendoroid/<?= $nendoroid['nendoroid_internalid'] ?>/<?= $nendoroid['nendoroid_url'] ?>/">
                      <?php } ?>
                        <span class="image fit" nendoroid="" name="<?= $nendoroid['nendoroid_name'] ?>" origin="<?= $nendoroid['nendoroid_origin'] ?>">
                          <img src="images/nendos/nendoroids/<?= $nendoroid['nendoroid_internalid'] ?>.jpg" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
<?php
  if( $withadd && isset($_SESSION['userid']) ){
?>
                      <div class="3u 4u(medium) 6u(small)">
                        <a href="<?php if(isset($box_id)){ ?>box/<?= $box_id ?>/<?= $box_url ?>/<?php } ?>addnendoroid">
                          <span class="image fit withadd" id="withadd_nendoroid" title="Add a Nendoroid">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
