        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h2>Hairs</h2>
              </header>
              <section class="tiles">
<?php
foreach ($hairs as $hair) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/hairs/<?= $hair['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="face/<?= $hair['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
            </div>
          </div>