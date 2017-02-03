<?php if( $hidden ){ ?>
                    <div class="row" style="display:none;">
<?php } else { ?>
                    <div class="row">
<?php } ?>
<?php
  foreach ($photos as $photo) {
?>
                      <div class="3u 4u(medium) 6u(small)">
                      <?php if($withlinks){ ?>
                        <a href="photo/<?= $photo['photo_internalid'] ?>/">
                      <?php } ?>
                        <span class="image fit"
                              photo=""
                              photo_title="<?= $photo['photo_title'] ?>"
                              photo_username="<?= $photo['photo_username'] ?>"
                              sortingfield="<?= $sortingfield ?>"
                              sortingvalue="<?= $photo[$sortingfield] ?>">
                          <img src="images/nendos/photos/<?= $photo['photo_internalid'] ?>_thumb" alt="" />
                        </span>
                      <?php if($withlinks){ ?>
                        </a>
                      <?php } ?>
                      </div>
<?php
  }
?>
<?php
  if( $withadd && isEditor() ){
?>
                      <div class="3u 4u(medium) 6u(small)">
                        <a href="addphoto">
                          <span class="image fit withadd" id="withadd_photo" title="Add a Photo">
                            <p><i class="icon fa-plus"></i></p>
                          </span>
                        </a>
                      </div>
<?php
  }
?>
                    </div>
