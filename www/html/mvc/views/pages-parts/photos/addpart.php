        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u$">
                  <b>Photo: </b><?= $photo['photo_title'] ?> <i>(by <?= $photo['photo_username'] ?>)</i>
                  <input type="hidden" id="photoid" name="photoid" value="<?= $photo['photo_internalid'] ?>" />
                </div>
              </div>
              <div class="row">
                <div class="12u$">
                  <b id="step_1">(1) Choose a box</b>
                  <span id="box_cancel" style="display:none;"><a>Reset box selection</a></span>
                </div>
                <div class="12u$" id="box_chooser_container">
                  <input type="text" id="box_chooser" name="box_chooser" placeholder="Enter the name of the box/nendoroid..." />
                  <div id="box_choosen" style="display:none;"></div>
                </div>
                <input type="hidden" id="box_choosen_id" />
              </div>
              <div class="row" id="parttype_chooser_row" style="display:none;">
                <div class="12u$">
                  <b id="step_2">(2) Choose a part type</b>
                </div>
                <div class="12u$">
                  <div class="row" id="parttype_chooser">
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_boxes.png" alt="boxes" title="Box" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_nendo.png" alt="nendoroids" title="Nendoroid" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_face.png" alt="faces" title="Face" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_hair.png" alt="hairs" title="Hair" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_hand.png" alt="hands" title="Hand" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_body.png" alt="bodyparts" title="Bodypart" />
                    </div>
                    <div class="1u 2u(medium) 3u(small)">
                      <img src="images/icon_nendo_accessories.png" alt="accessories" title="Accessory" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="part_chooser_row" style="display:none;">
                <div class="12u$">
                  <b id="step_3">(3) Choose a part</b>
                </div>
                <div class="12u$">
                  <div class="row" id="part_chooser">
                  </div>
                </div>
              </div>
              <div class="row" id="image_container">
                <div class="12u$" id="step_4_container" style="display:none;">
                  <b id="step_4">(4) Draw a rectangle to select the part on the image (optional)</b><br/>
                  <i>First click on image start the rectangle, second click stop the rectangle, going outside the image cancel the rectangle...</i><br/>
                  <i>Once the rectangle is drawn, click on it if you want to remove it...</i>
                </div>
                <div class="12u$">
                  <div class="image-and-annotations">
                    <img src="images/nendos/photos/<?= $photo['photo_internalid'] ?>_full"
                         original_width="<?= $photo['photo_width'] ?>" original_height="<?= $photo['photo_height'] ?>"
                         alt="<?= $photo['photo_title'] ?>"
                         class="annotated-image"
                         style="width:10%;" />
                    <div class="image-annotation-drawer" id="drawn_annotation">
                      <a class="image-annotation-link">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="button_container" style="display:none;">
                <div class="12u$">
                  <b id="step_5">(5) Validate your choices</b>
                </div>
                <div class="12u$">
                  <input type="button" id="submit_choices" name="submit_choices" value="Submit my choices" />
                </div>
              </div>
            </div>
          </div>
