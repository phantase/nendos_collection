<?php

if( isset($_GET['target']) ){
  $target = $_GET['target'];
  switch($target){
    case "add":
      $page_title = "Add a new Nendoroid";
      include_once('mvc/models/boxes.php');
      if( isset($_GET['box_id']) ){
        $box_id = $_GET['box_id'];
        $box = get_singleBox($box_id);
        $boxes = array($box);
      } else {
        $boxes = get_allBoxes();
      }
      break;
    default:
      die('error');
      break;
  }

  include_once('mvc/views/pages/skeleton.php');

} else {
  die('error');
}
