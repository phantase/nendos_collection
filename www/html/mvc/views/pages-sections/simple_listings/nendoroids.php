                    <div class="row">
<?php
  foreach ($nendoroids as $nendoroid) {
?>
                      <div class="4u 6u(medium)">
                      <?php if($withlinks){ ?>
                        <a href="nendoroid/<?= $nendoroid['box_name'] ?>/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit" nendoroid="" name="<?= $nendoroid['name'] ?>" origin="<?= $nendoroid['origin'] ?>">
                          <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
                    </div>
