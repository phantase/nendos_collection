<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allAccessories($selected_order,$selected_direction);
if( $resultInfo[0] == "00000" ){
  $accessories = $resultInfo[4];
  $page_title = "Accessories";
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
