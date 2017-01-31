              <section class="tiles">
<?php
foreach ($faces as $face) {
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
                    <img src="images/nendos/faces/<?= $face['internalid'] ?>_thumb" alt="" />
                  </span>
                  <a href="face/<?= $face['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
