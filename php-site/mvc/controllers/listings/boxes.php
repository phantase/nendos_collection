<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allBoxes($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0]=="00000" ){
  $boxes = $resultInfo[4];
  foreach ($boxes as $key => $box) {
    $boxes[$key]['box_url'] = urlize($box['box_name']);
    if( $box['coll_additiondate'] ) {
      $boxes[$key]['coll_additionsince'] = ((new DateTime($box['now']))->diff(new DateTime($box['coll_additiondate'])));
    }
  }
  $page_title = "Boxes";

  $box = $boxes[0];

  $og_title = "Already " . count($boxes) . " boxes described in Nendoroids-db";
  $og_description = "We have " . count($boxes) . " boxes described in Nendoroids-db. "
        . "The last one is " . $box['box_category'] 
        . ((isset($box['box_number']) && strlen($box['box_number'])>0)?" #".$box['box_number']:"") 
        . " - " . $box['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/boxes/" . $box['box_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}
include_once('mvc/views/pages/skeleton.php');
