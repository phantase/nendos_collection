              <section class="tiles">
<?php
foreach ($boxes as $box) {
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
                    <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="box/<?= $box['name'] ?>_<?= $box['internalid'] ?>/">
                    <div class="content">
                      <h4><?= $box['type'] ?> #<?= $box['name'] ?></h4>
                    </div>
                  </a>
                </article>
<?php
}
?>
              </section>
