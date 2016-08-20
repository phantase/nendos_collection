        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(medium)">
                  <span class="image fit">
                    <img src="images/nendos/boxes/<?= $box['internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
                      <i class="icon style2 fa-edit included" title="Add/Change the picture"></i>
                    <?php } ?>
                  </span>
                </div>
                <div  class="8u 12u(medium)">
                  <h4>Nendoroids</h4>
<?php showNendoroidsListing($nendoroids,"simple",null,true); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u 12u(medium)">
              <h4>Faces</h4>
<?php showFacesListing($faces,"simple",null); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Hairs</h4>
<?php showHairsListing($hairs,"simple",null); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Hands</h4>
<?php showHandsListing($hands,"simple",null); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Body Parts</h4>
<?php showBodyPartsListing($bodyparts,"simple",null); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,"simple",null); ?>
                </div>
              </div>

            </div>
          </div>
