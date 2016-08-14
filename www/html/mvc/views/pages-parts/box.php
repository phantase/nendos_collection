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
<?php
  $divider = "fourth";
  include("mvc/views/pages-sections/nendoroids.php");
?>
              <h4>Faces</h4>
<?php include("mvc/views/pages-sections/faces.php"); ?>
              <h4>Hands</h4>
<?php include("mvc/views/pages-sections/hands.php"); ?>
              <h4>Body Parts</h4>
<?php include("mvc/views/pages-sections/bodyparts.php"); ?>
              <h4>Hairs</h4>
<?php include("mvc/views/pages-sections/hairs.php"); ?>
              <h4>Accessories</h4>
<?php include("mvc/views/pages-sections/accessories.php"); ?>
                </div>
              </div>

            </div>
          </div>
