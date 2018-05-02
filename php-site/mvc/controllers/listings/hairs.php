<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allHairs($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0] == "00000" ){
  $hairs = $resultInfo[4];
  foreach ($hairs as $key => $hair) {
    if( $hair['coll_additiondate'] ) {
      $hairs[$key]['coll_additionsince'] = ((new DateTime($hair['now']))->diff(new DateTime($hair['coll_additiondate'])));
    }
  }
  $page_title = "Hairs";

  $hair = $hairs[0];

  $og_title = "Already " . count($hairs) . " hairs described in Nendoroids-db";
  $og_description = "We have " . count($hairs) . " hairs described in Nendoroids-db. "
        . "The last one is a " . $hair['hair_haircut']
        . " - From box: " . $hair['box_category'] 
        . ((isset($hair['box_number']) && strlen($hair['box_number'])>0)?" #".$hair['box_number']:"") 
        . " - " . $hair['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/hairs/" . $hair['hair_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
