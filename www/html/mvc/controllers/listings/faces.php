<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allFaces($selected_order,$selected_direction);
if( $resultInfo[0] == "00000" ){
  $faces = $resultInfo[4];
  $page_title = "Faces";
} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
