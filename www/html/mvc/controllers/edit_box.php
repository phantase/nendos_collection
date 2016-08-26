<?php

if( isset($_GET['target']) ){
  $target = $_GET['target'];
  switch($target){
    case "add":
      $page_title = "Add a new Box";
      break;
    case "edit":
      if( isset($_GET['boxinternalid'])){
        $boxinternalid = $_GET['boxinternalid'];

        include_once('mvc/models/boxes.php');
        $box = get_singleBox($boxinternalid);

        $page_title = "Edit Box - ".$box['type']." #".$box['name'];
      } else {
        die('error');
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
