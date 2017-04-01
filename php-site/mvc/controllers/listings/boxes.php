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
} else {
  raiseError($resultInfo[2]);
}
include_once('mvc/views/pages/skeleton.php');
