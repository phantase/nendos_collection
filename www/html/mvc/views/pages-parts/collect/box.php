        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u">
                  Choose the parts you want to add to your collection
                  (by default, all of them are selected, so just click on <b>Collect</b> button to add the whole box).
                </div>
              </div>
              <section class="collect_section">
                <div class="row uniform">
                  <div class="2u 4u(medium) 6u(small)">
                    <a class="button">Collect</a>
                  </div>
<?php showBoxCollecting($box); ?>
<?php showNendoroidsCollecting($nendoroids); ?>
<?php showFacesCollecting($faces); ?>
<?php showHairsCollecting($hairs); ?>
<?php showHandsCollecting($hands); ?>
<?php showBodyPartsCollecting($bodyparts); ?>
<?php showAccessoriesCollecting($accessories); ?>
                  <div class="2u 4u(medium) 6u(small)">
                    <a class="button">Collect</a>
                  </div>
                </div>
              </section>
            </div>
          </div>
