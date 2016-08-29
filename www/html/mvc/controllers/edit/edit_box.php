<?php

if( isset($_GET['target']) ){
  $target = $_GET['target'];
  switch($target){
    case "add":
      $page_title = "Add a new Box";
      break;
    default:
      die('error');
      break;
  }

  include_once('mvc/views/pages/skeleton.php');

} else {
  die('error');
}
