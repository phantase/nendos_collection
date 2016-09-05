<?php

if( isset($_GET['box_internalid']) ){
  $box_internalid = $_GET['box_internalid'];
  $resultInfo = get_singleBox($box_internalid);
  if($resultInfo[0]=="00000"){
    $box = $resultInfo[4];
    $boxes = array($box);
  } else {
    $include_page = "error";
    $page_title = "Error";
  }
} else {
  $resultInfo = get_allBoxes();
  if($resultInfo[0]=="00000"){
    $boxes = $resultInfo[4];
  } else {
    $include_page = "error";
    $page_title = "Error";
  }
}
if( isset($_GET['nendoroid_internalid']) ){
  $nendoroid_internalid = $_GET['nendoroid_internalid'];
  $resultInfo = get_singleNendoroid($nendoroid_internalid);
  if($resultInfo[0]=="00000"){
    $nendoroid = $resultInfo[4];
    $nendoroids = array($nendoroid);
  } else {
    $include_page = "error";
    $page_title = "Error";
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
    $include_page = "error";
    $page_title = "Error";
  }
}
