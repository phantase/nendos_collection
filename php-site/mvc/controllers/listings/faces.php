<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allFaces($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0] == "00000" ){
  $faces = $resultInfo[4];
  foreach ($faces as $key => $face) {
    if( $face['coll_additiondate'] ) {
      $faces[$key]['coll_additionsince'] = ((new DateTime($face['now']))->diff(new DateTime($face['coll_additiondate'])));
    }
  }
  $page_title = "Faces";

  $face = $faces[0];

  $og_title = "Already " . count($faces) . " faces described in Nendoroids-db";
  $og_description = "We have " . count($faces) . " faces described in Nendoroids-db. "
        . "The last one comes from box: " . $face['box_category'] 
        . ((isset($face['box_number']) && strlen($face['box_number'])>0)?" #".$face['box_number']:"") 
        . " - " . $face['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/faces/" . $face['face_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
