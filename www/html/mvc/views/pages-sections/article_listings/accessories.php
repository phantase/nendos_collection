              <section class="tiles">
<?php
foreach ($accessories as $accessory) {
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
                    <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>_thumb" alt="" />
                  </span>
                  <a href="accessory/<?= $accessory['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
