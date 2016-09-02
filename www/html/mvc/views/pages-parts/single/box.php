        <!-- Main -->
          <div id="main">
            <div class="inner">
              <div class="row">
                <div  class="4u 12u(small)">
                  <span class="image fit" id="span_box<?= $box['box_internalid'] ?>">
                  <span class="image fit" id="span_box<?= $box['box_internalid'] ?>">
                    <img src="images/nendos/boxes/<?= $box['box_internalid'] ?>.jpg" alt="" />
                    <?php if(isset($_SESSION['userid'])){ ?>
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
  tableField('number','Number',$box['box_number']);
  tableField('name','Name',$box['box_name']);
  tableField('series','Series',$box['box_series']);
  tableField('manufacturer','Manufacturer',$box['box_manufacturer']);
  tableField('category','Category',$box['box_category']);
  tableField('price','Price &yen;',$box['box_price']);
  tableField('releasedate','Release date',((isset($box['box_releasedate'])?(split("-",$box['box_releasedate'])[0]."/".split("-",$box['box_releasedate'])[1]):null)));
  tableField('specifications','Specifications',$box['box_specifications']);
  tableField('sculptor','Sculptor',$box['box_sculptor']);
  tableField('cooperation','Cooperation',$box['box_cooperation']);
  tableFieldWithLink('officialurl','Links','GSC product page',$box['box_officialurl']);
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div  class="12u">
                  <h4>Nendoroids</h4>
<?php showNendoroidsListing($nendoroids,"simple",true,true,$box['box_url'],$box['box_internalid']); ?>
                </div>
              </div>
              <div class="row">
                <div class="6u 12u(medium)">
              <h4>Faces</h4>
<?php showFacesListing($faces,"simple",true,true,$box['name'],$box['internalid']); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Hairs</h4>
<?php showHairsListing($hairs,"simple",true,true,$box['name'],$box['internalid']); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Hands</h4>
<?php showHandsListing($hands,"simple",true,true,$box['name'],$box['internalid']); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Body Parts</h4>
<?php showBodyPartsListing($bodyparts,"simple",true,true,$box['name'],$box['internalid']); ?>
                </div>
                <div class="6u 12u(medium)">
              <h4>Accessories</h4>
<?php showAccessoriesListing($accessories,"simple",true,true,$box['name'],$box['internalid']); ?>
                </div>
              </div>
              <hr/>
<?php include('mvc/views/pages-sections/others/metadata.php'); ?>
            </div>
          </div>