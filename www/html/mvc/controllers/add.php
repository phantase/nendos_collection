<?php

if( isset($_GET['element']) && strlen($_GET['element'])>0 ){
  $element = $_GET['element'];
  switch($element){
    case "box":
      $include_page = "add/".$element;
      $page_title = "Add a ".$element;
      include_once('mvc/views/pages/skeleton.php');
      break;
    default:
      include_once('mvc/views/home.php');
  }
} else {
  include_once('mvc/views/home.php');
}
