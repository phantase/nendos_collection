<?php

if( !isAdministrator() ){
  raiseError("You don't have right to do that.");
}

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "signupdate";
  $selected_direction = "desc";
}

$resultInfo = get_allUsers($selected_order,$selected_direction);
if( $resultInfo[0] == "00000" ){
  $users = $resultInfo[4];
  $page_title = "Users";
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
