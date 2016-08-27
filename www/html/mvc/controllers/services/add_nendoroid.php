<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_nendoroid_box_id']) && strlen($_POST['new_nendoroid_box_id'])>0
 && isset($_POST['new_nendoroid_name']) && strlen($_POST['new_nendoroid_name'])>0
 && isset($_POST['new_nendoroid_origin'])
 && isset($_POST['new_nendoroid_version'])
 && isset($_POST['new_nendoroid_editor'])
 && isset($_POST['new_nendoroid_color']) && strlen($_POST['new_nendoroid_color'])>0 ){

  $nendoroid_box_id = $_POST['new_nendoroid_box_id'];
  $nendoroid_name = $_POST['new_nendoroid_name'];
  $nendoroid_origin = $_POST['new_nendoroid_origin'];
  $nendoroid_version = $_POST['new_nendoroid_version'];
  $nendoroid_editor = $_POST['new_nendoroid_editor'];
  $nendoroid_color = $_POST['new_nendoroid_color'];
  if(strlen($nendoroid_color)>6){
    $nendoroid_color = substr($nendoroid_color,1);
  }
  $nendoroid_url = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid_name)));

  include_once('mvc/models/nendoroids.php');

  $internalid = add_singleNendoroid($nendoroid_box_id,
                                    $nendoroid_name,
                                    $nendoroid_origin,
                                    $nendoroid_version,
                                    $nendoroid_editor,
                                    $nendoroid_color);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'nendoroid_internalid'=>$internalid,
                          'nendoroid_box_id'=>$nendoroid_box_id,
                          'nendoroid_name'=>$nendoroid_name,
                          'nendoroid_origin'=>$nendoroid_origin,
                          'nendoroid_version'=>$nendoroid_version,
                          'nendoroid_editor'=>$nendoroid_editor,
                          'nendoroid_color'=>$nendoroid_color,
                          'nendoroid_url'=>$nendoroid_url));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
