<?php

if( isset($_GET['element']) && strlen($_GET['element'])>0 ){
  $element = $_GET['element'];
  switch($element){
    case "box":
      include_once('mvc/controllers/services/add/add_'.$element.'.php');
      break;
    default:
      echo json_encode(array('result'=>'failure','reason'=>'Bad element'));
      exit;
  }
} else {
  echo json_encode(array('result'=>'failure','reason'=>'Missing element'));
  exit;
}
