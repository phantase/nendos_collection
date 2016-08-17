        <!-- Main -->
          <div id="main">
            <div class="inner">
              <header>
                <div class="row">
                  <div class="9u">
                    <h2>Boxes</h2>
                  </div>
                  <div class="3u">
<?php if(isset($_SESSION['userid'])){ ?>
                    <input type="button" id="newBox" value="Add a new box" />
                    <input type="button" id="noNewBox" value="No new box" />
                  </div>
                </div>
                <div class="row bordered" id="newBoxForm">
                  <div class="5u">
                    <input type="text" name="name" id="name" placeholder="Name" />
                  </div>
                  <div class="4u">
                    <input type="text" name="type" id="type" placeholder="Type" />
                  </div>
                  <div class="3u">
                    <input type="button" id="createBox" value="Add the box" />
<?php } ?>
                  </div>
                </div>
              </header>
<br/>
<?php showBoxesListing($boxes,"article","sixth"); ?>

            </div>
          </div>
