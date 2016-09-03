<?php


  if( isset($_GET['box_internalid']) ){
    $box_internalid = $_GET['box_internalid'];
    $box = get_singleBox($box_internalid);
    $boxes = array($box);
  } else {
    $boxes = get_allBoxes();
  }
