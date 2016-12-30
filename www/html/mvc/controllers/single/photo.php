<?php

if( !isset($_GET['photo_internalid']) ){
  raiseError("There is no photo id provided.");
}

$photo_internalid = $_GET['photo_internalid'];

$resultInfo = get_singlePhoto($photo_internalid);

if($resultInfo[0]=="00000"){

  $photo = $resultInfo[4];

  $page_title = "Photo";

} else {
  raiseError($resultInfo[2]);
}

$resultInfo = get_nendoroidsPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $nendoroids = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_accessoriesPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $accessories = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
