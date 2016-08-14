              <section class="tiles">
<?php
foreach ($nendoroids as $nendoroid) {
if( isset($divider) ){
?>
                <article class="<?= $divider ?>">
<?php
} else {
?>
                <article>
<?php
}
?>
                  <span class="image fit">
                    <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="nendoroid/<?= $nendoroid['box_name'] ?>/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
                    <div class="content">
                      <h4><?= $nendoroid['name'] ?></h4>
                    </div>
                  </a>
                </article>
<?php
}
?>
              </section>
