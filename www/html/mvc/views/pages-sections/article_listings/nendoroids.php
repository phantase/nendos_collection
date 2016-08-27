              <section class="tiles">
<?php
foreach ($nendoroids as $nendoroid) {
?>
                <style>
                  .tiles article#nendo_<?= $nendoroid['internalid'] ?> > .image:before {
                    background-color: #<?= $nendoroid['dominant_color'] ?>;
                  }
                </style>
                <?php
  if( isset($divider) ){
?>
                <article id="nendo_<?= $nendoroid['internalid'] ?>" class="<?= $divider ?>">
<?php
  } else {
?>
                <article id="nendo_<?= $nendoroid['internalid'] ?>">
<?php
  }
?>
                  <span class="image fit">
                    <img src="images/nendos/nendoroids/<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="nendoroid/<?= $nendoroid['box_name'] ?>/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
<?php if( $renderer == "article" ) { ?>
                    <div class="content">
                      <h4><?= $nendoroid['name'] ?></h4>
                    </div>
<?php } else  if( $renderer == "home" ) { ?>
                    <h2>#<?= $nendoroid['box_name'] ?><br/><?= $nendoroid['name'] ?></h2>
                    <div class="content">
                      <p><?= $nendoroid['origin'] ?> - <?= $nendoroid['name'] ?> - <?= $nendoroid['box_type'] ?> #<?= $nendoroid['box_name'] ?> - <?= $nendoroid['version'] ?> (<?= $nendoroid['editor'] ?>)</p>
                    </div>
<?php } ?>
                  </a>
                </article>
<?php
}
?>
              </section>
