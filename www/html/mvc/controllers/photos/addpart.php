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

$resultInfo = get_allBoxes("box_number","DESC");
if($resultInfo[0]=="00000"){
  $boxes = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allNendoroids("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $nendoroids = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allAccessories("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $accessories = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allBodyParts("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $bodyparts = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allFaces("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $faces = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allHairs("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $hairs = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_allHands("nendoroid_name","DESC");
if($resultInfo[0]=="00000"){
  $hands = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
