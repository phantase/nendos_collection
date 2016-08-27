                    <div class="row">
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                      <div class="4u 6u(medium)">
                      <?php if($withlinks){ ?>
                        <a href="nendoroid/<?= $nendoroid['box_name'] ?>/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" nendoroid="" name="<?= $nendoroid['name'] ?>" origin="<?= $nendoroid['origin'] ?>">
                          <img src="images/nendos/nendoroids/<?= $nendoroid['internalid'] ?>.jpg" alt="" />
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
                      <div class="4u 6u(medium)">
                        <a href="box/<?= $box_name ?>_<?= $box_id ?>/addnendoroid">
                          <span class="image fit withadd" id="withadd_nendoroid" title="Add a Nendoroid">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
