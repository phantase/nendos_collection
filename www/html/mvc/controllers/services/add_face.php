<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_box_name']) && strlen($_POST['new_box_name'])>0 && isset($_POST['new_box_type']) && strlen($_POST['new_box_type'])>0 ){

  $box_name = $_POST['new_box_name'];
  $box_type = $_POST['new_box_type'];

  include_once('mvc/models/boxes.php');

  $boxinternalid = add_singleBox($box_name,$box_type);
  if( isset($boxinternalid) ){
    echo json_encode(array('result'=>'success','box_internalid'=>$boxinternalid,'box_name'=>$box_name,'box_type'=>$box_type));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
