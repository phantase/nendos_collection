<?php

if( isset($_GET['target']) ){
  $target = $_GET['target'];
  switch($target){
    case "add":
      $page_title = "Add a new Nendoroid";
      if( isset($_GET['box_id']) && isset($_GET['box_name']) ){
        $box_name = 484;
        $box_id = 1;
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
