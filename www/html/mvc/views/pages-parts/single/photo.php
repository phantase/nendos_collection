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
                        <tr>
                          <td colspan="6" class="photo_cell">
                            <div class="image-and-annotations">
                              <img src="images/nendos/photos/<?= $photo['photo_internalid'] ?>_full"
                                   original_width="<?= $photo['photo_width'] ?>" original_height="<?= $photo['photo_height'] ?>"
                                   alt="<?= $photo['photo_title'] ?>"
                                   class="annotated-image"
                                   style="width:10%;" />
<?php foreach ($nendoroids as $key => $nendoroid) { ?>
                              <div class="image-annotation"
                                   nendoroid="<?= $nendoroid['nendoroid_internalid'] ?>"
                                   xmin="<?= $nendoroid['pn_xmin'] ?>"
                                   ymin="<?= $nendoroid['pn_ymin'] ?>"
                                   xmax="<?= $nendoroid['pn_xmax'] ?>"
                                   ymax="<?= $nendoroid['pn_ymax'] ?>"
                                   title="<?= $nendoroid['nendoroid_name'] ?>">
                                <a class="image-annotation-link"></a>
                              </div>
<?php } ?>
<?php foreach ($accessories as $key => $accessory) { ?>
                              <div class="image-annotation"
                                   accessory="<?= $accessory['accessory_internalid'] ?>"
                                   xmin="<?= $accessory['pa_xmin'] ?>"
                                   ymin="<?= $accessory['pa_ymin'] ?>"
                                   xmax="<?= $accessory['pa_xmax'] ?>"
                                   ymax="<?= $accessory['pa_ymax'] ?>"
                                   title="<?= $accessory['accessory_type'] ?>">
                                <a class="image-annotation-link"></a>
                              </div>
<?php } ?>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
