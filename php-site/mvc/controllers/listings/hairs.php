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
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
