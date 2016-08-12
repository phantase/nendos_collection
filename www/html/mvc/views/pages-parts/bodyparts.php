        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h2>Body Parts</h2>
              </header>
              <section class="tiles">
<?php
foreach ($bodyparts as $bodypart) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/bodyparts/<?= $bodypart['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="face/<?= $bodypart['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
            </div>
          </div>
