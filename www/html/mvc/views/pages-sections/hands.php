              <section class="tiles">
<?php
foreach ($hands as $hand) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/hands/<?= $hand['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="face/<?= $hand['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
