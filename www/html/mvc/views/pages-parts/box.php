        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u">
                  <span class="image fit">
                    <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                  </span>
                </div>
                <div  class="8u">
                  <h4>Nendoroids</h4>
<?php showNendoroidsListing($nendoroids,"article",null); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Faces</h4>
<?php showFacesListing($faces,"article","fourth"); ?>
                </div>
                <div class="6u">
              <h4>Hairs</h4>
<?php showHairsListing($hairs,"article","fourth"); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Hands</h4>
<?php showHandsListing($hands,"article","fourth"); ?>
                </div>
                <div class="6u">
              <h4>Body Parts</h4>
<?php showBodyPartsListing($bodyparts,"article","fourth"); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,"article","fourth"); ?>
                </div>
              </div>

            </div>
          </div>
