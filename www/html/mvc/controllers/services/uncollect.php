<?php

header('Content-Type: application/json');

if( ! isLogged() ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

  if(isset($_GET['element']) && strlen($_GET['element'])>0){

    $element = $_GET['element'];
    $internalid = $_GET['internalid'];
    $userid = $_SESSION['userid'];

    $resultInfo = uncollect_singleElement($element,$internalid,$userid);
    if($resultInfo[0] == "00000"){
      echo json_encode(array('result'=>'success','element'=>$element,'internalid'=>$internalid));
    } else {
      echo json_encode(array('result'=>'failure','reason'=>$resultInfo[2]));
    }
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Missing parameters'));
      exit;
  }
