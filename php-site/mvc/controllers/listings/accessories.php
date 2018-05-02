<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allAccessories($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0] == "00000" ){
  $accessories = $resultInfo[4];
  foreach ($accessories as $key => $accessory) {
    if( $accessory['coll_additiondate'] ) {
      $accessories[$key]['coll_additionsince'] = ((new DateTime($accessory['now']))->diff(new DateTime($accessory['coll_additiondate'])));
    }
  }
  $page_title = "Accessories";

  $accessory = $accessories[0];

  $og_title = "Already " . count($accessories) . " accessories described in Nendoroids-db";
  $og_description = "We have " . count($accessories) . " accessories described in Nendoroids-db. "
        . "The last one is a " . $accessory['accessory_type']
        . " - From box: " . $accessory['box_category'] 
        . ((isset($accessory['box_number']) && strlen($accessory['box_number'])>0)?" #".$accessory['box_number']:"") 
        . " - " . $accessory['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/accessories/" . $accessory['accessory_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
