        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h2>Faces</h2>
              </header>
              <section class="tiles">
<?php
foreach ($faces as $face) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/faces/<?= $face['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="face/<?= $face['internalid'] ?>/">
                  </a>
                </article>
<?php
}
?>
              </section>
            </div>
          </div>
