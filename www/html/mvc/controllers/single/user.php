<?php

if( !isAdministrator() ){
  raiseError("You don't have right to do that.");
}

if( isset($_GET['userid']) ){
  $userid = $_GET['userid'];

  $resultInfo = get_singleUser($userid);

  if($resultInfo[0]=="00000"){

    $user = $resultInfo[4];

    $page_title = "User";

  } else {
    raiseError($resultInfo[2]);
  }

} else {
  raiseError("There is no user id provided.");
}

include_once('mvc/views/pages/skeleton.php');
