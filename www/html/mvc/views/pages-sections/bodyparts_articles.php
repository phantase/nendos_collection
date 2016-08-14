              <section class="tiles">
<?php
foreach ($bodyparts as $bodypart) {
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
                    <img src="images/nendos/bodyparts/<?= $bodypart['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="bodypart/<?= $bodypart['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
