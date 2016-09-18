        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(small)">
                  <span class="image fit" id="span_box<?= $box['box_internalid'] ?>">
                    <img src="images/nendos/boxes/<?= $box['box_internalid'] ?>.jpg" alt="" />
                    <?php if( isEditor() && ! $box['db_validatorid'] ){ ?>
                      <i class="icon style2 fa-edit included editpic" id="editpic_box<?= $box['box_internalid'] ?>" title="Add/Change the picture" part="box" internalid="<?= $box['box_internalid'] ?>"></i>
                    <?php } ?>
                  </span>
                  <fieldset class="dropzone image fit" id="drop_box<?= $box['box_internalid'] ?>" style="display:none;">
                    <p>Drop a file here, <br/>or click to browse your computer...</p>
                  </fieldset>
                </div>
                <div class="8u 12u(small)">
                  <div class="table-wrapper">
                    <table id="info_table" element="box" internalid="<?= $box['box_internalid'] ?>">
                      <tbody>
<?php
  tableFieldValidate($box['db_validatorid']);
  tableField('number','Number',$box['box_number'],!$box['db_validatorid']);
  tableField('name','Name',$box['box_name'],!$box['db_validatorid']);
  tableField('series','Series',$box['box_series'],!$box['db_validatorid']);
  tableField('manufacturer','Manufacturer',$box['box_manufacturer'],!$box['db_validatorid']);
  tableField('category','Category',$box['box_category'],!$box['db_validatorid']);
  tableField('price','Price &yen;',$box['box_price'],!$box['db_validatorid']);
  tableField('releasedate','Release date',((isset($box['box_releasedate'])?(split("-",$box['box_releasedate'])[0]."/".split("-",$box['box_releasedate'])[1]):null)),!$box['db_validatorid']);
  tableField('specifications','Specifications',$box['box_specifications'],!$box['db_validatorid']);
  tableField('sculptor','Sculptor',$box['box_sculptor'],!$box['db_validatorid']);
  tableField('cooperation','Cooperation',$box['box_cooperation'],!$box['db_validatorid']);
  tableFieldWithLink('officialurl','Links','GSC product page',$box['box_officialurl'],!$box['db_validatorid']);
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
<?php if(isEditor() || count($nendoroids)>0){ ?>
              <div class="row">
                <div  class="12u">
                  <h4>Nendoroids</h4>
<?php showNendoroidsListing($nendoroids,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
              </div>
<?php } ?>
              <div class="row">
<?php if(isEditor() || count($faces)>0){ ?>
                <div class="6u 12u(medium)">
              <h4>Faces</h4>
<?php showFacesListing($faces,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
<?php } ?>
<?php if(isEditor() || count($hairs)>0){ ?>
                <div class="6u 12u(medium)">
              <h4>Hairs</h4>
<?php showHairsListing($hairs,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
<?php } ?>
<?php if(isEditor() || count($hands)>0){ ?>
                <div class="6u 12u(medium)">
              <h4>Hands</h4>
<?php showHandsListing($hands,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
<?php } ?>
<?php if(isEditor() || count($bodyparts)>0){ ?>
                <div class="6u 12u(medium)">
              <h4>Body Parts</h4>
<?php showBodyPartsListing($bodyparts,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
<?php } ?>
<?php if(isEditor() || count($accessories)>0){ ?>
                <div class="6u 12u(medium)">
              <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,null,true,!$box['db_validatorid'],$box['box_url'],$box['box_internalid']); ?>
                </div>
<?php } ?>
              </div>
              <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
<?php include('mvc/views/pages-sections/others/history.php'); ?>
            </div>
          </div>
