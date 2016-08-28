<?php

header('Content-Type: application/json');

if( ! isset($_SESSION['userid']) ){
  echo json_encode(array('result'=>'failure','reason'=>'Not authorized'));
  exit;
}

if( isset($_POST['new_hair_box_id']) && strlen($_POST['new_hair_box_id'])>0
 && isset($_POST['new_hair_nendoroid_id'])
 && isset($_POST['new_hair_main_color'])
 && isset($_POST['new_hair_main_color_hex'])
 && isset($_POST['new_hair_other_color'])
 && isset($_POST['new_hair_other_color_hex'])
 && isset($_POST['new_hair_haircut'])
 && isset($_POST['new_hair_frontback'])
 && isset($_POST['new_hair_description'])){

  $hair_box_id = $_POST['new_hair_box_id'];
  $hair_nendoroid_id = $_POST['new_hair_nendoroid_id'];
  $hair_main_color = $_POST['new_hair_main_color'];
  $hair_main_color_hex = $_POST['new_hair_main_color_hex'];
  if(strlen($hair_main_color_hex)>6){
    $hair_main_color_hex = substr($hair_main_color_hex,1);
  }
  $hair_other_color = $_POST['new_hair_other_color'];
  $hair_other_color_hex = $_POST['new_hair_other_color_hex'];
  if(strlen($hair_other_color_hex)>6){
    $hair_other_color_hex = substr($hair_other_color_hex,1);
  }
  $hair_haircut = $_POST['new_hair_haircut'];
  $hair_frontback = $_POST['new_hair_frontback'];
  $hair_description = $_POST['new_hair_description'];

  include_once('mvc/models/hairs.php');

  $internalid = add_singleHair($hair_box_id,
                                $hair_nendoroid_id,
                                $hair_main_color,
                                $hair_main_color_hex,
                                $hair_other_color,
                                $hair_other_color_hex,
                                $hair_haircut,
                                $hair_frontback,
                                $hair_description);
  if( isset($internalid) && $internalid != 0 ){
    echo json_encode(array('result'=>'success',
                          'hair_internalid'=>$internalid,
                          'hair_box_id'=>$hair_box_id,
                          'hair_nendoroid_id'=>$hair_nendoroid_id,
                          'hair_main_color'=>$hair_main_color,
                          'hair_main_color_hex'=>$hair_main_color_hex,
                          'hair_other_color'=>$hair_other_color,
                          'hair_other_color_hex'=>$hair_other_color_hex,
                          'hair_haircut'=>$hair_haircut,
                          'hair_frontback'=>$hair_frontback,
                          'hair_description'=>$hair_description));
  } else {
    echo json_encode(array('result'=>'failure','reason'=>'Not able to create DB record'));
  }


} else {
  echo json_encode(array('result'=>'failure','reason'=>'Bad parameters'));
}
