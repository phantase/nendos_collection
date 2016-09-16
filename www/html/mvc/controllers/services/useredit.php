<?php

header('Content-Type: application/json');

if( isAdministrator() ){
  if(isset($_GET['userid']) && strlen($_GET['userid'])>0){

    $userid = $_GET['userid'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $resultInfo = edit_singleUser($userid,$field,$value);
    if($resultInfo[0] == "00000"){
      echo json_encode(array('result'=>'success','userid'=>$userid,'field'=>$field,'value'=>$value));
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
