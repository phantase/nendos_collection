        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u">
                  Choose the parts you want to add to your collection (just click <b>Collect</b> to add all of them)
                </div>
              </div>
              <section>
                <form>
                  <div class="row uniform">
                    <div class="12u">
                      <div class="table-wrapper">
                        <table id="collect_table" element="box" internalid="<?= $box['hair_internalid'] ?>">
                          <tbody>
<?php showBoxCollecting($box); ?>
<?php showNendoroidsCollecting($nendoroids); ?>
<?php showFacesCollecting($faces); ?>
<?php showHairsCollecting($hairs); ?>
<?php showHandsCollecting($hands); ?>
<?php showBodyPartsCollecting($bodyparts); ?>
<?php showAccessoriesCollecting($accessories); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </form>
              </section>
            </div>
          </div>
