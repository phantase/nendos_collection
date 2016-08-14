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
              <h4>Faces</h4>
<?php showFaces($faces,"article","fourth"); ?>
              <h4>Hands</h4>
<?php showHands($hands,"article","fourth"); ?>
              <h4>Body Parts</h4>
<?php showBodyParts($bodyparts,"article","fourth"); ?>
              <h4>Hairs</h4>
<?php showHairs($hairs,"article","fourth"); ?>
              <h4>Accessories</h4>
<?php showAccessories($accessories,"article","fourth"); ?>
                </div>
              </div>

            </div>
          </div>
