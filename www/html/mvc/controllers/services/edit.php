<?php

header('Content-Type: application/json');

if(canEdit()){
  if(isset($_GET['element']) && strlen($_GET['element'])>0
    && isset($_POST['field']) && strlen($_POST['field'])>0
    && isset($_POST['value']) && strlen($_POST['value'])>0){

    $element = $_GET['element'];
    $internalid = $_GET['internalid'];
    $field = $_POST['field'];
    $value = $_POST['value'];
    $userid = $_SESSION['userid'];

    $resultInfo = edit_singleElement($element,$internalid,$field,$value,$userid);
    if($resultInfo[0] == "00000"){
      echo json_encode(array('result'=>'success','element'=>$element,'internalid'=>$internalid,'field'=>$field,'value'=>$value));
    } else {
      echo json_encode(array('result'=>'failure','errorInfo'=>$resultInfo[2]));
    }
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Missing parameters'));
      exit;
  }
} else {
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
    exit;
}
