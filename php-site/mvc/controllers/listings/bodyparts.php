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
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
