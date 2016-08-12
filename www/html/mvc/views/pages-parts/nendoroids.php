        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h2>Nendoroids</h2>
              </header>
              <section class="tiles">
<?php
foreach ($nendoroids as $nendoroid) {
?>
                <article class="sixth">
                  <span class="image fit">
                    <img src="images/nendos/nendoroids/tile-<?= $nendoroid['internalid'] ?>.jpg" alt="" />
                  </span>
                  <a href="nendoroid/<?= $nendoroid['url'] ?>_<?= $nendoroid['internalid'] ?>/">
                    <div class="content">
                      <h4><?= $nendoroid['name'] ?></h4>
                    </div>
                  </a>
                </article>
<?php
}
?>
              </section>
            </div>
          </div>
