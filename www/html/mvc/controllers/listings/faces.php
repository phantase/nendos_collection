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
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
