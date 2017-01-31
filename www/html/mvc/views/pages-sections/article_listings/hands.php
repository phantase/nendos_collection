              <section class="tiles">
<?php
foreach ($hands as $hand) {
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
                    <img src="images/nendos/hands/<?= $hand['internalid'] ?>_thumb" alt="" />
                  </span>
                  <a href="hand/<?= $hand['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
