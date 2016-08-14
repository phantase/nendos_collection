        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <h1>BOX: <?= $box['type'] ?> #<?= $box['name'] ?></h1>
              </header>

              <div class="row">
                <div  class="4u">
                  <span class="image fit">
                    <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                  </span>
                </div>
                <div  class="8u">
                  <h4>Nendoroids</h4>
<?php showNendoroids($nendoroids,"article",null); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Faces</h4>
<?php showFaces($faces,"article","fourth"); ?>
                </div>
                <div class="6u">
              <h4>Hairs</h4>
<?php showHairs($hairs,"article","fourth"); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Hands</h4>
<?php showHands($hands,"article","fourth"); ?>
                </div>
                <div class="6u">
              <h4>Body Parts</h4>
<?php showBodyParts($bodyparts,"article","fourth"); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u">
              <h4>Accessories</h4>
<?php showAccessories($accessories,"article","fourth"); ?>
                </div>
              </div>

            </div>
          </div>
