        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div class="12u$">
                  <div class="table-wrapper">
                    <table id="info_table" element="photo" internalid="<?= $user['internalid'] ?>">
                      <tbody>
                        <tr>
                          <th>Title</th>
                          <td colspan="5">
                            <?= $photo['photo_title'] ?>
                          </td>
                        </tr>
                        <tr>
                          <th>By</th>
                          <td>
                            <?= $photo['photo_username'] ?>
                          </td>
                          <th>Uploaded on</th>
                          <td>
                            <?= $photo['photo_uploaded'] ?>
                          </td>
                          <th>Updated on</th>
                          <td>
                            <?= $photo['photo_updated'] ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="12u$">
                  <div class="image-and-annotations">
                    <img src="images/nendos/photos/<?= $photo['photo_internalid'] ?>_full"
                         original_width="<?= $photo['photo_width'] ?>" original_height="<?= $photo['photo_height'] ?>"
                         alt="<?= $photo['photo_title'] ?>"
                         class="annotated-image"
                         style="width:10%;" />
<?php foreach ($nendoroids as $key => $nendoroid) { ?>
                    <div class="image-annotation" id="photo_nendoroid_<?= $nendoroid['pn_internalid'] ?>"
                         xmin="<?= $nendoroid['pn_xmin'] ?>"
                         ymin="<?= $nendoroid['pn_ymin'] ?>"
                         xmax="<?= $nendoroid['pn_xmax'] ?>"
                         ymax="<?= $nendoroid['pn_ymax'] ?>"
                          nendoroid=""
                          nendoroid_name="<?= $nendoroid['nendoroid_name'] ?>"
                          nendoroid_version="<?= $nendoroid['nendoroid_version'] ?>"
                          box_number="<?= $nendoroid['box_number'] ?>"
                          box_category="<?= $nendoroid['box_category'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-nendoroid"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($accessories as $key => $accessory) { ?>
                    <div class="image-annotation" id="photo_accessory_<?= $accessory['pa_internalid'] ?>"
                         xmin="<?= $accessory['pa_xmin'] ?>"
                         ymin="<?= $accessory['pa_ymin'] ?>"
                         xmax="<?= $accessory['pa_xmax'] ?>"
                         ymax="<?= $accessory['pa_ymax'] ?>"
                          accessory=""
                          type="<?= $accessory['accessory_type'] ?>"
                          description="<?= $accessory['accessory_description'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-accessory"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($bodyparts as $key => $bodypart) { ?>
                    <div class="image-annotation" id="photo_bodypart_<?= $bodypart['pbp_internalid'] ?>"
                         xmin="<?= $bodypart['pbp_xmin'] ?>"
                         ymin="<?= $bodypart['pbp_ymin'] ?>"
                         xmax="<?= $bodypart['pbp_xmax'] ?>"
                         ymax="<?= $bodypart['pbp_ymax'] ?>"
                          bodypart=""
                          part="<?= $bodypart['bodypart_part'] ?>"
                          description="<?= $bodypart['bodypart_description'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-bodypart"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($boxes as $key => $box) { ?>
                    <div class="image-annotation" id="photo_box_<?= $box['pb_internalid'] ?>"
                         xmin="<?= $box['pb_xmin'] ?>"
                         ymin="<?= $box['pb_ymin'] ?>"
                         xmax="<?= $box['pb_xmax'] ?>"
                         ymax="<?= $box['pb_ymax'] ?>"
                          box=""
                          box_number="<?= $box['box_number'] ?>"
                          box_name="<?= $box['box_name'] ?>"
                          box_category="<?= $box['box_category'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-box"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($faces as $key => $face) { ?>
                    <div class="image-annotation" id="photo_face_<?= $face['pf_internalid'] ?>"
                         xmin="<?= $face['pf_xmin'] ?>"
                         ymin="<?= $face['pf_ymin'] ?>"
                         xmax="<?= $face['pf_xmax'] ?>"
                         ymax="<?= $face['pf_ymax'] ?>"
                          face=""
                          eyes="<?= $face['face_eyes'] ?>"
                          mouth="<?= $face['face_mouth'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-face"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($hairs as $key => $hair) { ?>
                    <div class="image-annotation" id="photo_hair_<?= $hair['ph_internalid'] ?>"
                         xmin="<?= $hair['ph_xmin'] ?>"
                         ymin="<?= $hair['ph_ymin'] ?>"
                         xmax="<?= $hair['ph_xmax'] ?>"
                         ymax="<?= $hair['ph_ymax'] ?>"
                          hair=""
                          frontback="<?= $hair['hair_frontback'] ?>"
                          haircut="<?= $hair['hair_haircut'] ?>"
                          description="<?= $hair['hair_description'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-face"></div>
                      </a>
                    </div>
<?php } ?>
<?php foreach ($hands as $key => $hand) { ?>
                    <div class="image-annotation" id="photo_hand_<?= $hand['ph_internalid'] ?>"
                         xmin="<?= $hand['ph_xmin'] ?>"
                         ymin="<?= $hand['ph_ymin'] ?>"
                         xmax="<?= $hand['ph_xmax'] ?>"
                         ymax="<?= $hand['ph_ymax'] ?>"
                          hand=""
                          leftright="<?= $hand['hand_leftright'] ?>"
                          posture="<?= $hand['hand_posture'] ?>">
                      <a class="image-annotation-link">
                        <div class="image-annotation-face"></div>
                      </a>
                    </div>
<?php } ?>
                  </div>
                </div>
              </div>
              <hr/>
              <div class="row">
                <div class="12u$">
                  <h4 id="toggle_parts"><a>Parts (<span style="display:none;">show</span><span>hide</span>)</a></h4>
                  <div class="row">
<?php
  $cellsize = "1u 2u(medium) 3u(small)";
  showBoxesListing(       $boxes,       array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showNendoroidsListing(  $nendoroids,  array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showFacesListing(       $faces,       array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showHairsListing(       $hairs,       array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showHandsListing(       $hands,       array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showBodypartsListing(   $bodyparts,   array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
  showAccessoriesListing( $accessories, array('withlinks'=>true,'shareddiv'=>true,'cellsize'=>$cellsize));
?>
<?php if(isEditor()){ ?>
                      <div class="<?= $cellsize ?>">
                        <a href="photo/<?= $photo['photo_internalid'] ?>/addpart">
                          <span class="image fit withadd" id="withadd_part" title="Add a Part to this photo">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php } ?>
                  </div>
                </div>
              </div>
<?php include('mvc/views/pages-sections/others/history.php'); ?>
            </div>
          </div>
