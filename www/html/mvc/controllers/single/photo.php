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

$resultInfo = get_boxesPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $boxes = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_nendoroidsPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
  }
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_accessoriesPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $accessories = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_bodypartsPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $bodyparts = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_facesPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $faces = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_handsPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $hands = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}
$resultInfo = get_hairsPhoto($photo_internalid);
if($resultInfo[0]=="00000"){
  $hairs = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
