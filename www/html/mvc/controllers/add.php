<?php

if( canEdit() ){

  if( isset($_GET['element']) && strlen($_GET['element'])>0 ){
    $element = $_GET['element'];
    switch($element){
      case "box":
      case "nendoroid":
      case "face":
      case "hair":
      case "hand":
      case "bodypart":
      case "accessory":
        $include_page = "add/".$element;
        $page_title = "Add a ".$element;
        include_once('mvc/controllers/add/'.$element.'.php');
        break;
      default:
        raiseEror("This element is not supported.");
    }
  } else {
    raiseError("There is no element provided.");
  }

} else {
  raiseError("You must be logged in with right credentials to add an element.");
}

include_once('mvc/views/pages/skeleton.php');
