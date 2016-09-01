<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_box_number'])
  && isset($_POST['new_box_name']) && strlen($_POST['new_box_name'])>0
  && isset($_POST['new_box_category']) && strlen($_POST['new_box_category'])>0
  && isset($_POST['new_box_officialurl']) && strlen($_POST['new_box_officialurl'])>0 ){

  $box_number = $_POST['new_box_number'];
  $box_name = $_POST['new_box_name'];
  $box_category = $_POST['new_box_category'];
  $box_officialurl = $_POST['new_box_officialurl'];

  include_once('mvc/models/boxes.php');

  $box_internalid = add_singleBox($box_number,$box_name,$box_category,$box_officialurl,$_SESSION['userid']);
  if( isset($box_internalid) ){
    echo json_encode(array(
        'result'          =>  'success',
        'box_internalid'  =>  $box_internalid,
        'box_number'      =>  $box_number,
        'box_name'        =>  $box_name,
        'box_category'    =>  $box_category,
        'box_officialurl' =>  $box_officialurl,
        'box_url'         =>  urlize($box_name)));
  } else {
    echo json_encode(array(
        'result'  =>  'failure',
        'reason'  =>  'Not able to create DB record'));
  }


} else {
  echo json_encode(array(
        'result'  =>  'failure',
        'reason'  =>  'Bad parameters'));
}
