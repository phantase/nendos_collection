<?php

if( isset($_GET['target']) ){
  $target = $_GET['target'];
  switch($target){
    case "add":
      $page_title = "Add a new Accessory";

      include_once('mvc/models/boxes.php');
      include_once('mvc/models/nendoroids.php');

      if( isset($_GET['box_id']) ){
        $box_id = $_GET['box_id'];
        $box = get_singleBox($box_id);
        $boxes = array($box);
      } else {
        $boxes = get_allBoxes();
      }
      if( isset($_GET['nendoroid_id']) ){
        $nendoroid_id = $_GET['nendoroid_id'];
        $nendoroid = get_singleNendoroid($nendoroid_id);
        $nendoroids = array($nendoroid);
      } else {
        if( isset($_GET['box_id']) ){
          $box_id = $_GET['box_id'];
          $nendoroids = get_boxNendoroids($box_id);
        } else {
          $nendoroids = get_allNendoroids();
        }
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
