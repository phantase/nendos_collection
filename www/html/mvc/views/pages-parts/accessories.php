        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h2>Accessories</h2>
              </header>
              <section class="tiles">
<?php
foreach ($accessories as $accessory) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/accessories/<?= $accessory['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="face/<?= $accessory['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
            </div>
          </div>
