        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h1>Boxes</h1>
              </header>
              <section>
                <div class="box alt">
                  <div class="row uniform">
<?php
foreach ($boxes as $box) {
?>
                    <div class="2u">
                      <span class="image fit">
                        <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                      </span>
                    </div>
<?php
}
?>
                  </div>
                </div>
              </section>
            </div>
          </div>
