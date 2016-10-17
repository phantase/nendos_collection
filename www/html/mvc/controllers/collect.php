<?php

if( ! isLogged() ){
  raiseError("You must be logged in to collect an element.");
}

  if( isset($_GET['element']) && strlen($_GET['element'])>0 ){
    $element = $_GET['element'];
    switch($element){
      case "box":
      //case "nendoroid":
      //case "face":
      //case "hair":
      //case "hand":
      //case "bodypart":
      //case "accessory":
        $include_page = "collect/".$element;
        $page_title = "Collect a ".$element;
        include_once('mvc/controllers/collect/'.$element.'.php');
        break;
      default:
        raiseEror("This element is not supported.");
    }
  } else {
    raiseError("There is no element provided.");
  }

include_once('mvc/views/pages/skeleton.php');
