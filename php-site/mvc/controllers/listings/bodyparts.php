<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allBodyParts($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0] == "00000" ){
  $bodyparts = $resultInfo[4];
  foreach ($bodyparts as $key => $bodypart) {
    if( $bodypart['coll_additiondate'] ) {
      $bodyparts[$key]['coll_additionsince'] = ((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['coll_additiondate'])));
    }
  }
  $page_title = "Bodyparts";

  $bodypart = $bodyparts[0];

  $og_title = "Already " . count($bodyparts) . " bodyparts described in Nendoroids-db";
  $og_description = "We have " . count($bodyparts) . " bodyparts described in Nendoroids-db. "
        . "The last one is a " . $bodypart['bodypart_part']
        . " - From box: " . $bodypart['box_category'] 
        . ((isset($bodypart['box_number']) && strlen($bodypart['box_number'])>0)?" #".$bodypart['box_number']:"") 
        . " - " . $bodypart['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/bodyparts/" . $bodypart['bodypart_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
