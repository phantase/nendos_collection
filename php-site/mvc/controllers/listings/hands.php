<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allHands($selected_order,$selected_direction,$_SESSION['userid']);
if( $resultInfo[0] == "00000" ){
  $hands = $resultInfo[4];
  foreach ($hands as $key => $hand) {
    if( $hand['coll_additiondate'] ) {
      $hands[$key]['coll_additionsince'] = ((new DateTime($hand['now']))->diff(new DateTime($hand['coll_additiondate'])));
    }
  }
  $page_title = "Hands";

  $hand = $hands[0];

  $og_title = "Already " . count($hands) . " hands described in Nendoroids-db";
  $og_description = "We have " . count($hands) . " hands described in Nendoroids-db. "
        . "The last one is from box: " . $hand['box_category'] 
        . ((isset($hand['box_number']) && strlen($hand['box_number'])>0)?" #".$hand['box_number']:"") 
        . " - " . $hand['box_name'];
  $og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/hands/" . $hand['hand_internalid'] . "_thumb";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
