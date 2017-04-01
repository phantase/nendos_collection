              <section class="tiles">
<?php
foreach ($hairs as $hair) {
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
                    <img src="images/nendos/hairs/<?= $hair['internalid'] ?>_thumb" alt="" />
                  </span>
                  <a href="hair/<?= $hair['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
