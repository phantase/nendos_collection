<?php


  if( isset($_GET['box_internalid']) ){
    $box_internalid = $_GET['box_internalid'];
    $resultInfo = get_singleBox($box_internalid);
    if( $resultInfo[0] == "00000" ){
      $boxes = array($resultInfo[4]);
    } else {
      raiseError($resultInfo[2]);
    }
  } else {
    $resultInfo = get_allBoxes();
    if( $resultInfo[0] == "00000" ){
      $boxes = $resultInfo[4];
    } else {
      raiseError($resultInfo[2]);
    }
  }
