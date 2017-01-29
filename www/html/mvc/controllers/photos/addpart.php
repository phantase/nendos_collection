<?php

if( !isset($_GET['photo_internalid']) ){
  raiseError("There is no photo id provided.");
}

$photo_internalid = $_GET['photo_internalid'];

$resultInfo = get_singlePhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $photo = $resultInfo[4];
  $page_title = "Photo - Add part";
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
