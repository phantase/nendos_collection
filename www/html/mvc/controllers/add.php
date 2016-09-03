<?php

if( isset($_GET['element']) && strlen($_GET['element'])>0 ){
  $element = $_GET['element'];
  switch($element){
    case "box":
    case "nendoroid":
      $include_page = "add/".$element;
      $page_title = "Add a ".$element;
      include_once('mvc/controllers/add/'.$element.'.php');
      break;
    default:
      $include_page = "error";
      $page_title = "Error";
  }
} else {
  $include_page = "error";
  $page_title = "Error";
}

include_once('mvc/views/pages/skeleton.php');
