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

$og_title = "Photo: « " . $photo['photo_title'] . " »";
$og_description = "A photo uploaded in Nendoroids-db, « " 
      . $photo['photo_title'] . " »"
      . " from " . $photo['photo_username'];
$og_image = "http://" . $_SERVER['HTTP_HOST'] . "/images/nendos/photos/" . $photo['photo_internalid'] . "_thumb";

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

$resultInfo = get_photoHistory($photo_internalid);
if($resultInfo[0]!="00000"){
  raiseError($resultInfo[2]);
}
$history = $resultInfo[4];
foreach ($history as $key => $histentry) {
  $history[$key]['history_actioninterval'] = ((new DateTime($histentry['now']))->diff(new DateTime($histentry['history_actiondate'])));
  $history[$key]['box_url'] = urlize($histentry['box_name']);
  if( isset($histentry['nendoroid_name']) ){
    $history[$key]['nendoroid_url'] = urlize($histentry['nendoroid_name']);
  }
}


include_once('mvc/views/pages/skeleton.php');
