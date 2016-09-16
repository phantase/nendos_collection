<?php

if( !isset($_GET['userid']) ){
  raiseError("There is no user id provided.");
}

if( !(isAdministrator() || $_SESSION['userid']==$_GET['userid']) ){
  raiseError("You don't have right to do that.");
}

$userid = $_GET['userid'];

$resultInfo = get_singleUser($userid);

if($resultInfo[0]=="00000"){

  $user = $resultInfo[4];

  $page_title = "User";

} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
