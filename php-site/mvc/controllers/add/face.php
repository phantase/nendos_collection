<?php

if( ! isEditor() ){
  raiseError("You must be logged in with right credentials to add an element.");
}

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];
  $resultInfo = get_singleBox($box_internalid);
  if($resultInfo[0]=="00000"){
    $box = $resultInfo[4];
    $boxes = array($box);
  } else {
    raiseError($resultInfo[2]);
  }
} else {
  $resultInfo = get_allBoxes();
  if($resultInfo[0]=="00000"){
    $boxes = $resultInfo[4];
  } else {
    raiseError($resultInfo[2]);
  }
}
if( isset($_GET['nendoroid_internalid']) ){
  $nendoroid_internalid = $_GET['nendoroid_internalid'];
  $resultInfo = get_singleNendoroid($nendoroid_internalid);
  if($resultInfo[0]=="00000"){
    $nendoroid = $resultInfo[4];
    $nendoroids = array($nendoroid);
  } else {
    raiseError($resultInfo[2]);
  }
} else {
  if( isset($_GET['box_internalid']) ){
    $box_internalid = $_GET['box_internalid'];
    $resultInfo = get_boxNendoroids($box_internalid);
  } else {
    $resultInfo = get_allNendoroids();
  }
  if($resultInfo[0]=="00000"){
    $nendoroids = $resultInfo[4];
  } else {
    raiseError($resultInfo[2]);
  }
}
